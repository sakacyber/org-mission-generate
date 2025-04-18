<?php

namespace App\Http\Controllers;

use App\Exports\MissionsExport;
use App\Models\Department;
use App\Models\Mission;
use App\Models\Person;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Developermithu\Tallcraftui\Traits\WithTcToast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use PhpOffice\PhpWord\TemplateProcessor;

class MissionController extends Controller
{
    use WithTcToast;

    public function __construct()
    {
        // Share this variable with all views used by this controller
        View::share('appTitle', 'Mission');
    }

    public function index(Request $request)
    {
        $missions = Mission::with('people.department')
            // search by goal
            ->when($request->search, function ($query) use ($request) {
                return $query->where('goal', 'like', "%{$request->search}%");
            })
            // search by department
            ->when($request->department_id, function ($query) use ($request) {
                return $query->whereHas('people', function ($query) use ($request) {
                    return $query->where('department_id', $request->department_id);
                });
            })
            // sort
            ->when($request->sort, function ($query) use ($request) {
                return $query->orderBy($request->sort);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $departments = Department::paginate(20);

        return view('missions.index', compact('missions', 'departments'));
    }

    public function create()
    {
        $fields = ['id', 'name'];
        $people = Person::orderBy('created_at', 'desc')->paginate(20, $fields)->pluck('name', 'id');

        return view('missions.create', compact('people'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'goal' => 'required',
            'place' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'signature_date' => 'required|date',
            'people_id' => 'required|array',
        ]);

        $mission = Mission::create($data);
        $mission->people()->attach($data['people_id']);

        return redirect()->route('missions.index', [
            'page' => request('page'),
            'search' => request('search'),
        ])->with('success', 'Mission created!');
    }

    public function show(Mission $mission)
    {
        return view('missions.show', compact('mission'));
    }

    public function edit(Mission $mission)
    {
        $fields = ['id', 'name'];
        $people = Person::orderBy('created_at', 'desc')
            // ->paginate(20, $fields)
            ->pluck('name', 'id');

        return view('missions.edit', compact('mission', 'people'));
    }

    public function update(Request $request, Mission $mission)
    {
        $data = $request->validate([
            'goal' => 'required',
            'place' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'signature_date' => 'required|date',
            'people_id' => 'required|array',
            'person_id.*' => 'exists:people,id',
        ]);

        $mission->update($data);
        $mission->people()->sync($data['people_id']);

        return redirect()->route('missions.index', [
            'page' => request('page'),
            'search' => request('search'),
        ])->with('success', 'Mission updated!');
    }

    public function destroy(Mission $mission)
    {
        $mission->delete();

        return redirect()->route('missions.index', [
            'page' => request('page'),
            'search' => request('search'),
        ])->with('success', 'Mission deleted!');
    }

    public function export($format)
    {
        $missions = Mission::all();

        if ($format === 'csv') {
            return response()->stream(function () use ($missions) {
                $handle = fopen('php://output', 'w');
                fputcsv($handle, ['Goal', 'Place', 'Start Date', 'End Date', 'Signature Date']);
                foreach ($missions as $mission) {
                    fputcsv($handle, [$mission->goal, $mission->place, $mission->start_date, $mission->start_date, $mission->signature_date]);
                }
                fclose($handle);
            }, 200, [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="missions.csv"',
            ]);
        } elseif ($format === 'xlsx') {
            return \Maatwebsite\Excel\Facades\Excel::download(new MissionsExport, 'missions.xlsx');
        }

        abort(404);
    }

    public function generateDocx($id)
    {
        $mission = Mission::findOrFail($id);
        $templatePath = storage_path('app/templates/mission_template_kh.docx');

        if (! file_exists($templatePath)) {
            abort(404, 'Template not found!');
        }

        $template = new TemplateProcessor($templatePath);

        // Set the locale date to Khmer
        Carbon::setLocale('km');
        $startDate = Carbon::parse($mission->start_date);
        $endDate = Carbon::parse($mission->end_date);
        $signatureDate = Carbon::parse($mission->signature_date);
        $startDateKh = toKhmerNumber($startDate->translatedFormat('ថ្ងៃទីd ខែF ឆ្នាំY'));
        $endDateKh = toKhmerNumber($endDate->translatedFormat('ថ្ងៃទីd ខែF ឆ្នាំY'));
        $sDateKh = toKhmerNumber($signatureDate->translatedFormat('ថ្ងៃទីd ខែF ឆ្នាំY'));

        // Set the values in the template
        $template->setValue('goal', $mission->goal);
        $template->setValue('place', $mission->place);
        $template->setValue('start_date', $startDateKh);
        $template->setValue('end_date', $endDateKh);
        $template->setValue('signature_date', $sDateKh);

        // Set the people list
        $people = $mission->people->map(function ($p) {
            return '• '.$p->name.' ('.$p->department->name.')';
        })->implode("\n \t\t\t\t");
        $template->setValue('people_list', $people, true);
        $template->setValue('go_date', toKhmerNumber($startDate->subDay()->translatedFormat('ថ្ងៃទីd ខែF ឆ្នាំY')));
        $template->setValue('back_date', toKhmerNumber($endDate->addDay()->translatedFormat('ថ្ងៃទីd ខែF ឆ្នាំY')));

        $fileName = 'mission_'.$mission->id.'.docx';
        $tempFilePath = storage_path("app/public/$fileName");
        $template->saveAs($tempFilePath);

        return response()->download($tempFilePath)->deleteFileAfterSend(true);
    }

    public function generatePdf(Mission $mission)
    {
        $mission->mission_date = Carbon::parse($mission->mission_date)->translatedFormat('d-m-Y ម.អ');
        $mission->ceo_signature_date = Carbon::parse($mission->ceo_signature_date)->translatedFormat('d-m-Y ម.អ');

        $pdf = Pdf::loadView('pdf.mission', compact('mission'));

        return $pdf->download('mission_'.$mission->id.'.pdf');
    }

    public function exportDocx(Mission $mission)
    {
        $templatePath = storage_path('app/templates/mission_template.docx');
        $fileName = 'mission_'.$mission->id.'.docx';

        $template = new TemplateProcessor($templatePath);

        $template->setValue('goal', $mission->goal);
        $template->setValue('place', $mission->place);
        $template->setValue('mission_date', $mission->mission_date);
        $template->setValue('signature_date', $mission->signature_date);

        $peopleList = $mission->people->map(function ($person) {
            return $person->name.' ('.$person->department->name.')';
        })->implode("\n");

        $template->setValue('people_list', $peopleList);

        $tempFilePath = storage_path("app/public/$fileName");
        $template->saveAs($tempFilePath);

        return response()->download($tempFilePath)->deleteFileAfterSend(true);
    }

    public function print(Mission $mission)
    {
        return view('missions.print', compact('mission'));
    }
}
