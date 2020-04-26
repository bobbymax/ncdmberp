<?php

namespace App\Http\Controllers;

use App\Training;
use App\TrainingDetail;
use App\Qualification;
use App\Major;
use Illuminate\Http\Request;
use App\Traits\HasFunction;
use App\Http\Requests\TrainingRequest;
use App\Classes\Base;
use App\User;
use Image;

class TrainingController extends Controller
{

    use HasFunction;

    /**
     * [$instance description]
     * @var [type]
     */
    protected $instance;

    protected $url;

    /**
     * 
     * Authentication Construct
     * 
     */
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
        $trainings = auth()->user()->trainings;
        // User::find(1)->notify(new TrainingCategorised);
        return view('modules.trainings.index', compact('trainings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $majors = Major::latest()->get();
        return view('modules.trainings.create', compact('majors'));
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
            'title' => 'required|string|max:255',
            'major_id' => 'required|integer',
        ]);

        $this->instance = $this->verifyExistance($request->title);

        if ($this->instance === null) {
            $this->instance = new Training;
            $this->instance->createOrUpdateFormat($request->all());
        }

        if (! in_array(auth()->user()->id, $this->instance->participants())) {
            $this->instance->addParticipant(auth()->user());
        }

        $this->url = $this->instance->details->count() >= 1 ? 'trainings.show' : 'details.create';

        return redirect()->route($this->url, $this->instance->label);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function show(Training $training)
    {
        return view('modules.trainings.show', compact('training'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function edit(Training $training)
    {
        $sponsors = Training::sponsors();
        $majors = Major::latest()->get();
        return view('modules.trainings.edit', compact('training', 'sponsors', 'majors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Training $training)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'major_id' => 'required|integer',
        ]);

        $training->createOrUpdateFormat($request->all());

        return redirect()->route('trainings.index')->with('status', 'Training record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function destroy(Training $training)
    {
        $training->delete();
        return back()->with('status', 'Training records deleted successfully.');
    }
}
