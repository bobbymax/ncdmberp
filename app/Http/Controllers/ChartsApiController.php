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

    	$labels = [" " . $confirmed .' - Verified - ' . $this->percentageStatus("approved"), " " . $pending . ' - Pending - ' . $this->percentageStatus("pending")];

    	$data = [$confirmed, $pending];

        return response()->json(compact('data', 'labels'));
    }

    public function pertTripStat()
    {
        $local = auth()->user()->trainingsCounter('local');
        $international = auth()->user()->trainingsCounter('international');

        $labels = [" " . $local . ' - Local - ' . auth()->user()->percentageTraining('local'), " " . $international . ' - International - ' . auth()->user()->percentageTraining('international')];

        $data = [$local, $international];

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
