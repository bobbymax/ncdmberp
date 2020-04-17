<?php

namespace App\Http\Controllers;

use App\Course;
use App\Qualification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseController extends Controller
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
        $courses = Course::latest()->get();
        return view('modules.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $qualifications = Qualification::latest()->get();
        return view('modules.courses.create', compact('qualifications'));
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
            'name' => 'required|string|max:255',
        ]);

        $course = new Course;

        $course->name = $request->name;
        $course->label = Str::slug($request->name);
        $course->description = $request->description;

        if ($course->save() && $request->has('qualifications')) {
            foreach ($request->qualifications as $value) {
                $qualification = Qualification::find($value);
                if ($qualification) {
                    $course->addQualification($qualification);
                }
            }
        }

        return redirect()->route('courses.index')->with('status', 'Course created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        return view('modules.courses.edit', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        $qualifications = Qualification::latest()->get();
        return view('modules.courses.edit', compact('course', 'qualifications'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'active' => 'required',
        ]);

        $course->name = $request->name;
        $course->label = Str::slug($request->name);
        $course->description = $request->description;
        $course->active = $request->active;

        if ($course->save() && $request->has('qualifications')) {
            foreach ($request->qualifications as $value) {
                $qualification = Qualification::find($value);
                if ($qualification && ! in_array($qualification->id, $course->currentQualifications())) {
                    $course->addQualification($qualification);
                }
            }
        }

        return redirect()->route('courses.index')->with('status', 'Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return back()->with('status', 'Course deleted successfully.');
    }
}
