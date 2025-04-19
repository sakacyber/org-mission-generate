<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class PersonController extends Controller
{
    public function __construct()
    {
        // Share this variable with all views used by this controller
        View::share('appTitle', 'People');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $people = Person::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%'.$search.'%');
        })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('people.index', compact('people'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::paginate(20)->pluck('name', 'id');

        return view('people.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'role' => 'required',
            'department_id' => 'required|exists:departments,id',
            'notes' => 'nullable',
        ]);

        Person::create($data);

        return redirect()->route('people.index')->with('success', 'Person created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Person $person)
    {
        return view('people.show', compact('person'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Person $person)
    {
        $departments = Department::paginate(20)->pluck('name', 'id');

        return view('people.edit', compact('person', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Person $person)
    {
        $data = $request->validate([
            'name' => 'required',
            'role' => 'required',
            'department_id' => 'required|exists:departments,id',
            'notes' => 'nullable',
        ]);

        $person->update($data);

        return redirect()->route('people.index')->with('success', 'Person updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Person $person)
    {
        $person->delete();

        return redirect()->route('people.index')->with('success', 'Person deleted successfully.');
    }
}
