<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TrainingDetail;
use App\Certificate;

use Illuminate\Database\Eloquent\Builder;

class ChartsApiController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}

    public function index()
    {
    	$confirmed = $this->statusCount("approved");
    	$pending = $this->statusCount("pending");
    	$local = auth()->user()->trainingsCounter('local');
    	$international = auth()->user()->trainingsCounter('international');

    	$labels = ['Verified - ' . $this->percentageStatus("approved"), 'Pending - ' . $this->percentageStatus("pending"), 'Local - ' . auth()->user()->percentageTraining('local'), 'International - ' . auth()->user()->percentageTraining('international')];

    	// $data = compact('confirmed', 'pending', 'denied');

    	$data = [$confirmed, $pending, $local, $international];

        return response()->json(compact('data', 'labels'));
    }

    public function percentageStatus($str)
    {
    	$status = $this->statusCount($str);
    	$trainings = auth()->user()->details->count();

    	$percent = ($status / $trainings) * 100;

    	return round($percent, 2) . "%";
    }

    public function statusCount($str)
    {
    	return Certificate::where('staff_id', auth()->user()->id)->where('status', $str)->count();
    }

}
