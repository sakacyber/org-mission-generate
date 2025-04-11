<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Department;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $people = Person::all();
        return view('people.index', compact('people')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        return view('people.create', compact('departments')); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Person::create($request->all());
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
        return view('people.edit', compact('person'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Person $person)
    {
        $person->update($request->all());
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