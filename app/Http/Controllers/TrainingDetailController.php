<?php

namespace App\Http\Controllers;

use App\TrainingDetail;
use App\Training;
use Illuminate\Http\Request;
use App\Http\Requests\TrainingRequest;
use App\Traits\RegularExpression;
use Illuminate\Support\Str;

class TrainingDetailController extends Controller
{

    use RegularExpression;

    private $instance;
    private $message;

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Training $training)
    {
        $trainings = $training->details;
        return view('modules.trainings.index', compact('trainings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Training $training)
    {
        return view('modules.details.create', compact('training'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TrainingRequest $request, Training $training)
    {
        // 0. Validation is done in TrainingRequest
        // 1. Check if training exists
        $this->instance = $training->verify($request->all());

        // 2. If training exists, check if details start_date and end_date collate with existing data
        if ($this->instance === null) {
            $this->instance = new TrainingDetail;
            $this->instance->createOrUpdateFormat($training, $request->all());

            $this->message = "Training Detail has been added successfully.";
        } else {
            $this->message = "This training  detail already exists in our database, however we have added you to the list of attendees.";
        }

        // 4. Check if user exists in training_staff relationship and skip or add user
        if (! in_array(auth()->user()->id, $this->instance->attendees())) {
            $this->instance->addAttendee(auth()->user());
        }


        return redirect()->route('trainings.index')->with('status', $this->message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TrainingDetail  $detail
     * @return \Illuminate\Http\Response
     */
    public function show(Training $training, TrainingDetail $detail)
    {
        return view('modules.details.show',  compact('training', 'detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TrainingDetail  $detail
     * @return \Illuminate\Http\Response
     */
    public function edit(Training $training, TrainingDetail $detail)
    {
        return view('modules.details.edit',  compact('training', 'detail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TrainingDetail  $detail
     * @return \Illuminate\Http\Response
     */
    public function update(TrainingRequest $request, Training $training, TrainingDetail $detail)
    {
        $detail->createOrUpdateFormat($training, $request->all());
        return redirect()->route('trainings.show', $training->label)->with('status', 'Training details updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TrainingDetail  $detail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Training $training, TrainingDetail $detail)
    {
        $detail->delete();
        return back()->with('status', 'Training details deleted successfully.');
    }
}
