<?php

namespace App\Http\Controllers;

use App\Nomination;
use App\Major;
use App\Training;
use App\TrainingDetail;
use App\User;
use App\Traits\HasFunction;
use Illuminate\Http\Request;
use App\Http\Requests\NominationRequest;

class NominationController extends Controller
{
    /**
     * Model Function Traits
     * 
     * @return response
     */
    use HasFunction;

    /**
     * Training Instance
     * 
     * @var training object
     */
    protected $training;

    /**
     * Training Detail Instance
     * 
     * @var detail object
     */
    protected $detail;

    /**
     * Nominated Staffs
     * 
     * @var staffs array
     */
    protected $staffs;

    /**
     * Nominated Staffs
     * 
     * @var staff instance
     */
    protected $staff;

    /**
     * Nominated Staffs
     * 
     * @var department instance
     */
    protected $department;

    /**
     * Nominated Staffs
     * 
     * array department instance
     */
    protected $departments = [];

    /**
     * Authentication construct
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
        $scheduled = TrainingDetail::with('nominations')
                                    ->where('status', 'scheduled')
                                    ->where('action', 'approved')
                                    ->latest()
                                    ->get();
        return view('modules.nominations.index', compact('scheduled'));
    }

    public function nominations()
    {
        $details = TrainingDetail::with('nominations')->where('status', 'nomination')->latest()->get();
        return view('modules.nominations.hr-nominations', compact('details'));
    }

    public function manage()
    {
        // 1. Get Training details that belong to currently signed in manager
        // 2. Load Staffs in same department
        // Get trainings where status is nominated
        // and users that belong to the department of the line manager
        $details = TrainingDetail::with('nominations')->where('status', 'nomination')->where('action', 'pending')->latest()->get();
        return view('modules.nominations.manage', compact('details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $majors = Major::latest()->get();
        $training = new Training;
        return view('modules.nominations.create', compact('majors', 'training'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NominationRequest $request)
    {
        $this->training = $this->verifyExistance($request->title);

        if ($this->training === null) {
            $this->training = new Training;
            $this->training->createOrUpdateFormat($request->all());
        }
        
        $this->detail = new TrainingDetail;
        $this->detail->createOrUpdateFormat($this->training, $request->all(), 'nomination', 'pending', false);
        // $this->departments = $this->detail->currentDepartments();

        // Fetch Staffs Request
        if ($request->staffs !== null) {
            $this->staffs = $this->splitStaffs($request->staffs);

            // Verify User details
            foreach ($this->staffs as $email) {
                $this->staff = $this->verifyByEmail($email);
                $this->department = $this->getDepartment($this->staff);

                // Persist nomination to database
                $nomination = new Nomination;
                $nomination->createOrUpdateFormat($this->staff, $this->detail, $this->department);

                // $nomination->user->notify(new )

                if (!in_array($this->department->id, $this->detail->currentDepartments())) {
                    $this->departments[] = $this->department->id;
                }
                // $this->detail->storeDepartment($this->department);
            }

            // foreach ($this->departments as $value) {
            //     $this->detail->storeDepartment($value);
            // }
        }
        
        return redirect()->route('hr.nominations')->with('status', 'Staffs nominations have been saved successfully.'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Nomination  $nomination
     * @return \Illuminate\Http\Response
     */
    public function show(TrainingDetail $nomination)
    {
        return view('modules.nominations.show', compact('nomination'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Nomination  $nomination
     * @return \Illuminate\Http\Response
     */
    public function hrShow(TrainingDetail $nomination)
    {
        return view('modules.nominations.hr-show', compact('nomination'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Nomination  $nomination
     * @return \Illuminate\Http\Response
     */
    public function edit(TrainingDetail $nomination)
    {
        $majors = Major::latest()->get();
        $training = new Training;
        return view('modules.nominations.edit', compact('majors', 'training', 'nomination'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Nomination  $nomination
     * @return \Illuminate\Http\Response
     */
    public function update(NominationRequest $request, TrainingDetail $nomination)
    {
        $this->training = $nomination->training;
        $this->training->createOrUpdateFormat($request->all());

        $this->detail = $nomination;
        $this->detail->createOrUpdateFormat($this->training, $request->all(), 'nomination', 'pending', false);
        // $this->departments = $this->detail->currentDepartments();

        if ($request->staffs !== null) {
            // Fetch Staffs Request
            $this->staffs = $this->splitStaffs($request->staffs);

            // Verify User details
            foreach ($this->staffs as $email) {

                $this->staff = $this->verifyByEmail($email);

                if (!$this->verifyRecord($this->staff->staff_no, $this->detail->id)) {
                    $this->department = $this->getDepartment($this->staff);
                    
                    // Persist nomination to database
                    $nomination = new Nomination;
                    $nomination->createOrUpdateFormat($this->staff, $this->detail, $this->department);

                    if (!in_array($this->department->id, $this->detail->currentDepartments())) {
                        $this->departments[] = $this->department->id;
                    }
                }
            }

            foreach ($this->departments as $value) {
                $this->detail->storeDepartment($value);
            }
        }

        return redirect()->route('hr.nominations')->with('status', 'Staffs nominations have been updated successfully.');

    }

    public function makeDecision(Request $request, Nomination $nomination)
    {
        $this->validate($request, [
            'approval' => 'required|string|max:255',
            'remark' => 'required|min:3',
        ]);

        $nomination->approval($request->all());

        return back()->with('status', 'Nomination updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Nomination  $nomination
     * @return \Illuminate\Http\Response
     */
    public function destroy(TrainingDetail $nomination)
    {
        //
    }
}
