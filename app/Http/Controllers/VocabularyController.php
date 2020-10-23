<?php

namespace App\Http\Controllers;

use App\Vocabulary;
use App\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VocabularyController extends Controller
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
        $vocabularies = Vocabulary::latest()->get();
        return view('pages.vocabularies.index', compact('vocabularies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grades = Grade::latest()->get();
        return view('pages.vocabularies.create', compact('grades'));
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
            'executive' => 'required',
            'code' => 'required|string|max:255',
        ]);


        $vocabulary = new Vocabulary;
        $vocabulary->createOrUpdateFormat($request->all());

        return redirect()->route('vocabularies.index')->with('status', 'Vocabulary added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vocabulary  $vocabulary
     * @return \Illuminate\Http\Response
     */
    public function show(Vocabulary $vocabulary)
    {
        return view('pages.vocabularies.show', compact('vocabulary'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vocabulary  $vocabulary
     * @return \Illuminate\Http\Response
     */
    public function edit(Vocabulary $vocabulary)
    {
        $grades = Grade::latest()->get();
        return view('pages.vocabularies.edit', compact('vocabulary', 'grades'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vocabulary  $vocabulary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vocabulary $vocabulary)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'executive' => 'required',
            'active' => 'required|integer',
            'code' => 'required|string|max:255',
        ]);

        $vocabulary->createOrUpdateFormat($request->all());

        return redirect()->route('vocabularies.index')->with('status', 'Vocabulary updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vocabulary  $vocabulary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vocabulary $vocabulary)
    {
        $vocabulary->delete();
        return back()->with('status', 'Vocabulary deleted successfully.');
    }
}
