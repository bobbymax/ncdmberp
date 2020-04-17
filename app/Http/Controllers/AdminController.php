<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\HasFunction;
use App\Training;
use App\TrainingDetail;
use App\User;
use App\Staff;

class AdminController extends Controller
{
	use HasFunction;

    public function __construct()
    {
    	$this->middleware('auth');
    }

    /**
     *
     * Displays Staff records with uncategorised trainings
     * @return [type] [description]
     */
    public function uncategorisedTrainings()
    {
    	$details = TrainingDetail::where('completed', 1)->where('categorised', 0)->get();
    	return view('modules.trainings.categorise', compact('details'));
    }

    public function schedule(TrainingDetail $detail)
    {
        // 1. Change Training Detail Status to Scheduled
        $detail->status = "scheduled";
        $detail->action = "approved";
        if ($detail->save()) {
            foreach ($detail->nominations as $nomination) {
                // 2. Update the nomination status
                $nomination->status = 1;
                $nomination->save();

                // 3. Add Nominated staffs training
                $detail->checkAndAddAttendee($nomination->staff->id);

                // 4. Add Nominated staffs to details
                $detail->training->checkAndAddParticipant($nomination->staff->id);
            }
        }

        return back()->with('status', 'Training has been scheduled successfully.');
    }

    /**
     * 
     * Displays uncategorized trainings for staff
     * L & D Officer Confirms category of training
     * 
     * @param  Training $training [description]
     * @return [type]             [description]
     */
    public function confirmCategory(TrainingDetail $training)
    {
    	$training->categorised = 1;
    	$training->save();

    	return back()->with('status', 'Training category has been confirmed and archived successfully.');
    }

    public function suggested()
    {
    	$proposals = $this->loggedInStaff();
    	return view('modules.trainings.suggested', compact('proposals'));
    }

    public function retract(User $staff, TrainingDetail $training)
    {
        $nomination = $this->verifyRecord($staff->staff_no, $training->id);
        if (! $nomination) {
            return back()->with('status', 'The Nomination record does not exist');
        }

        $nomination->delete();
        return back()->with('status', 'Staff removed successfully.');
    }
}
