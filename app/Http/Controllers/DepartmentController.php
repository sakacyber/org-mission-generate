<?php

namespace App\Http\Controllers;

use App\Exports\DepartmentsExport;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class DepartmentController extends Controller
{
    //

    public function __construct()
    {
        // Share this variable with all views used by this controller
        View::share('appTitle', 'Department');
    }

    public function index(Request $request)
    {
        $search = $request->get('search');
        $departments = Department::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%'.$search.'%');
        })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'notes' => 'required',
        ]);

        Department::create($data);

        return redirect()->route('departments.index')->with('success', 'Department created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        $people = $department->people()->paginate(10);

        return view('departments.show', compact('department', 'people'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        $department->update($request->all());

        return redirect()->route('departments.index')->with('success', 'Department updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $department->delete();

        return redirect()->route('departments.index')->with('success', 'Departments deleted successfully.');
    }

    public function export($format)
    {
        $departments = Department::all();

        if ($format === 'csv') {
            return response()->stream(function () use ($departments) {
                $handle = fopen('php://output', 'w');
                fputcsv($handle, ['Id', 'Name', 'Create Date']);
                foreach ($departments as $mission) {
                    fputcsv($handle, [$mission->id, $mission->name, $mission->created_at]);
                }
                fclose($handle);
            }, 200, [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="departments.csv"',
            ]);
        } elseif ($format === 'xlsx') {
            return \Maatwebsite\Excel\Facades\Excel::download(new DepartmentsExport, 'departments.xlsx');
        }

        abort(404);
    }
}
