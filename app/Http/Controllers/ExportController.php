<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use App\User;
use App\Training;
use App\TrainingDetail;
use PDF;
use DB;

class ExportController extends Controller
{

    protected $populated = [];
    protected $values = [];
    protected $queryable = [];
    protected $displays = [];

    public function __construct()
    {
    	$this->middleware('auth');
    }

    /**
	 * [trainings description]
	 * @param  User   $user [description]
	 * @return [type]       [description]
	 */
    public function trainings(User $staff)
    {
    	$pdf = PDF::loadView('modules.trainings.printable', compact('staff'));
		return $pdf->download($staff->name . ' Trainings.pdf');
    }

    public function trainingOptions()
    {
        // $trainings = auth()->user()->trainings;
        return view('modules.trainings.print-options');
    }

    public function printables(Request $request)
    {

        $this->queryable = $this->availableKeys($request->except(['_token', 'columns']));

        if (! empty($this->queryable)) {
            $query = DB::table('training_details');

            if (isset($request->columns)) {
                $query->select($request->columns);
            }

            $query->join('trainings', 'trainings.id', '=', 'training_details.training_id');

            foreach ($this->queryable as $key => $value) {
                if ($key === "course_id") {
                    $query->join('courses', 'courses.id', '=', 'training_details.course_id');
                }
                $query->where($key, $value);
            }

            $results = $query->get();   
        }

        // $pdf = PDF::loadView('modules.trainings.print-options', compact('results'));

        dd($results[0]);
        // dd($request->except('_token'));

    }

    protected function addQuery($param)
    {
        $syntax = TrainingDetail::class;
        $count = 1;
        foreach ($param as $key => $value) {
            if ($count == 1) {
                $syntax .= sprintf("::where('%s', '%s')", $key, $value);   
            } else {
                $syntax .= sprintf("->where('%s', '%s')", $key, $value);
            }
            $count++;
        }

        return $syntax .= '->get();';

        // return str_replace('"', '', $syntax);
    }

    public function availableKeys(array $data)
    {
        foreach ($data as $key => $value) {
            if ($value !== null) {
                $this->populated[] = $key;
                $this->values[] = $value;  
            }
        }

        return array_combine($this->populated, $this->values);
    }

    public function results($keys)
    {
        return DB::table('training_details')->select($keys)->get();
    }

}
