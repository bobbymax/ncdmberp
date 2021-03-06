<?php

namespace App\Http\Controllers;

use App\Department;
use App\Vocabulary;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::latest()->get();
        return view('pages.departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vocabularies = Vocabulary::latest()->get();
        $departments = Department::latest()->get();
        return view('pages.departments.create', compact('vocabularies', 'departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'vocabulary_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:departments',
            'parent' => 'required',
        ]);

        $department = new Department;

        $department->createOrUpdateFormat($request->all());
        return redirect()->route('departments.index')->with('status', 'Department created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        return view('pages.departments.show', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        $vocabularies = Vocabulary::latest()->get();
        $departments = Department::latest()->get();
        return view('pages.departments.edit', compact('department', 'vocabularies', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        $this->validate($request, [
            'vocabulary_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'parent' => 'required',
        ]);

        $department->createOrUpdateFormat($request->all());
        return redirect()->route('departments.index')->with('status', 'Department updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $department->delete();
        return back()->with('status', 'Department deleted successfully.');
    }
}
