<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\HasFunction;
use App\Training;
use App\Major;
use App\Certificate;
use App\TrainingDetail;
use App\Notifications\TrainingCategorised;
use App\User;
use App\Staff;
use App\Department;
use App\Application;
use App\Page;
use App\Role;

class AdminController extends Controller
{
	use HasFunction;

    protected $message;

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
    	$details = TrainingDetail::with('certificates')->where('completed', 1)->where('categorised', 0)->get();
    	return view('modules.trainings.categorise', compact('details'));
    }

    public function verifyStaffs(TrainingDetail $training)
    {
        return view('modules.trainings.confirm-staff', compact('training'));
    }

    public function trainingConfirmation(Certificate $certificate, $action = "approved")
    {
        $certificate->status = $action;
        $certificate->confirmed = 1;
        $certificate->save();

        if ($action === "denied") {
            $certificate->parent->staffs()->detach($certificate->staff);
            $certificate->parent->training->staffs()->detach($certificate->staff);

            // if ($certificate->parent->sponsor !== "ncdmb") {
            //     $certificate->parent->training->delete();
            // }

            $this->message = "Staff has been denied and removed from this training";
        } else {
            $this->message = 'Training for this staff has been confirmed';
        }

        return back()->with('status', $this->message);
    }

    public function trainingEdit(Training $training, TrainingDetail $detail)
    {
        $majors = Major::latest()->get();
        return view('modules.trainings.hr-edit', compact('training', 'detail', 'majors'));
    }

    public function revokeAppAccess(Application $application, Department $department)
    {
        $application->departments()->detach($department);

        return back()->with('status', 'Permissions revoked for this department successfully.');
    }

    public function detachDepartment(Department $department, Page $page)
    {
        $page->departments()->detach($department);
        return back()->with('status', 'Page permissions for this department has been revoked successfully.');
    }

    public function revokeRole(Role $role, Page $page)
    {
        $page->roles()->detach($role);
        return back()->with('status', 'Page permissions for this role have been revoked successfully.');
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

    public function hrUpdateTraining(Request $request, Training $training, TrainingDetail $detail)
    {
        $this->validate($request, [
            'major_id' => 'required|integer',
            'course_id' => 'required|integer'
        ]);

        if ($training->major->id != $request->major_id || $detail->course->id != $request->course_id) {
            // Training Update
            $training->major_id = $request->major_id;
            $training->save();

            // Training Details Update
            $detail->course_id = $request->course_id;
            $detail->save();

            $this->message = "Updates have been made to this training";
        } else {
            $this->message = "No changes made to this training";
        }

        return redirect()->route('uncategorise.trainings')->with('status', $this->message);
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
    	if ($training->save()) {

            foreach ($training->staffs as $staff) {
                $staff->notify(new TrainingCategorised($training));
            }

        }



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
