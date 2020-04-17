<?php

namespace App\Http\Controllers;

use App\Qualification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class QualificationController extends Controller
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
        $qualifications = Qualification::latest()->get();
        return view('modules.qualifications.index', compact('qualifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.qualifications.create');
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
            'period' => 'required|integer',
        ]);

        $qualification = new Qualification;

        $qualification->name = $request->name;
        $qualification->label = Str::slug($request->name);
        $qualification->period = $request->period;
        $qualification->description = $request->description;

        $qualification->save();

        return redirect()->route('qualifications.index')->with('status', 'Qualification created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Qualification  $qualification
     * @return \Illuminate\Http\Response
     */
    public function show(Qualification $qualification)
    {
        return view('modules.qualifications.show', compact('qualification'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Qualification  $qualification
     * @return \Illuminate\Http\Response
     */
    public function edit(Qualification $qualification)
    {
        return view('modules.qualifications.edit', compact('qualification'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Qualification  $qualification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Qualification $qualification)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'period' => 'required|integer',
        ]);

        $qualification->name = $request->name;
        $qualification->label = Str::slug($request->name);
        $qualification->description = $request->description;
        $qualification->period = $request->period;
        $qualification->status = $request->status;

        $qualification->save();

        return redirect()->route('qualifications.index')->with('status', 'Qualification updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Qualification  $qualification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Qualification $qualification)
    {
        $qualification->delete();
        return back()->with('status', 'Qualification deleted successfully.');
    }
}
