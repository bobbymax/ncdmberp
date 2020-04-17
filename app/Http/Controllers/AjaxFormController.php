<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\HasFunction;
use App\Classes\Base;
use App\Qualification;
use App\Training;
use App\TrainingDetail;
use App\Course;
use App\User;

class AjaxFormController extends Controller
{

    use HasFunction;

    protected $modified = [];

    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function reveal(Request $request)
    {
    	$data = Base::diffDays($request->start_date, $request->end_date);
    	$qualification = $this->fetchQualification($data);
    	return response()->json(['status' => 'success', 'value' => $qualification]);
    }

    public function autocomplete(Request $request)
    {
    	if ($request->ajax()) {
            $results = Training::select('title')->where("title", "LIKE", "%{$request->input('query')}%")->get();
            $data = $this->compile($results);
            
            return response()->json($data);
        }
    }

    public function loadStaffs(Request $request)
    {
        if ($request->ajax()) {
            $results = User::select('name', 'email', 'staff_no')
                            ->where("name", "LIKE", "%{$request->input('query')}%")
                            ->where("staff_no", "LIKE", "%{$request->input('query')}%")
                            ->where('type', '!=', 'adhoc')
                            ->where('status', 'available')->latest()->get();

            return response()->json($results);
        }
    }

    public function major(Request $request)
    {
        if ($request->ajax()) {
            $training = $this->verifyExistance($request->title);
            $result = $training !== null ? $training->major->id : 0;

            return response()->json(['status' => 'success', 'value' => $result]);
        }
    }

    public function addAttendeeToClass(TrainingDetail $detail)
    {
        $detail->addAttendee(auth()->user());
        return back()->with('status', 'You have been added to this class successfully.');
    }

    protected function compile($results)
    {
        foreach ($results as $result) {
            $this->addTitle($result->title);
        }

        return $this->modified;
    }

    protected function addTitle($value)
    {
        return $this->modified[] = $value;
    }

    protected function fetchQualification(int $days) : Qualification
    {
    	// $category_name = $days < 366 ? 'certificate' : 'diploma';
    	return $this->getQualification($this->normalizeRange($days));
    }

    protected function normalizeRange($value)
    {
        switch ($value) {
            case ($value >= 2) && ($value <= 90):
                return 'Certificate';
                break;

            case ($value >= 91) && ($value <= 185):
                return 'Diploma';
                break;

            default:
                return 'Degree';
                break;
        }
    }

    protected function getQualification($label)
    {
    	return Qualification::with('courses')->where('label', $label)->first();
    }
}
