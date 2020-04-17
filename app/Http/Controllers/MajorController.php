<?php

namespace App\Http\Controllers;

use App\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MajorController extends Controller
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
        $majors = Major::latest()->get();
        return view('modules.majors.index', compact('majors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.majors.create');
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

        $major = new Major;

        $major->name = $request->name;
        $major->label = Str::slug($request->name);

        $major->save();

        return redirect()->route('majors.index')->with('status', 'Course Major created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Major  $major
     * @return \Illuminate\Http\Response
     */
    public function show(Major $major)
    {
        return view('modules.majors.show', compact('major'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Major  $major
     * @return \Illuminate\Http\Response
     */
    public function edit(Major $major)
    {
        return view('modules.majors.edit', compact('major'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Major  $major
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Major $major)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'active' => 'required',
        ]);

        $major->name = $request->name;
        $major->label = Str::slug($request->name);
        $major->active = $request->active;

        $major->save();

        return redirect()->route('majors.index')->with('status', 'Course Major updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Major  $major
     * @return \Illuminate\Http\Response
     */
    public function destroy(Major $major)
    {
        $major->delete();
        return back()->with('status', 'Course Major deleted successfully.');
    }
}
