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
    	$confirmed = Certificate::where('staff_id', auth()->user()->id)->where('status', 'approved')->count();
    	$pending = Certificate::where('staff_id', auth()->user()->id)->where('status', 'pending')->count();
    	$denied = Certificate::where('staff_id', auth()->user()->id)->where('status', 'denied')->count();
    	$local = auth()->user()->trainingsCounter('local');
    	$international = auth()->user()->trainingsCounter('international');

    	// $data = compact('confirmed', 'pending', 'denied');

    	$data = [$confirmed, $pending, $denied, $local, $international];

        return response()->json(compact('data'));
    }
}
