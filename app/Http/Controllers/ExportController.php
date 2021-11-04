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
    protected $match_columns = [];
    protected $query, $results;

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
            $this->query = DB::table('training_details');

            $this->query->join('trainings', 'trainings.id', '=', 'training_details.training_id');
            $this->query->join('courses', 'courses.id', '=', 'training_details.course_id');
            $this->query->join('certificates', 'certificates.training_detail_id', '=', 'training_details.id');

            foreach ($this->queryable as $key => $value) {
                $this->query->where($key, $value);
            }

            $this->results = $this->query->get();

            if ($this->results === null) {
                return back()->with('errors', 'There are no trainings to be printed');
            }
        } else {
            return back()->with('errors', 'There are no parameters chosen');
        }

        $displays = (new Training)->displayColumns();

        if (isset($request->columns)) {
            foreach ($request->columns as $value) {
                if (in_array($value, array_keys($displays))) {
                    $this->match_columns[] = $displays[$value];
                }
            }
        }

        $columns = $request->columns;
        $displays = $this->match_columns;
        $data = $this->results->toArray();

        if (empty($data)) {
            return back()->with('errors', 'There are no trainings to be printed');
        }

        $staff_trainings = auth()->user()->trainings->first()->toArray();

        $loadables = compact('columns', 'displays', 'data', 'staff_trainings');

        $pdf = PDF::loadView('modules.trainings.print-options', compact('loadables'));
        return $pdf->download(auth()->user()->name . ' Trainings.pdf');

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
