<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\Base;

class DashboardController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	if (auth()->user()->isAdministrator()) {
    		return view('pages.index');
    	}

    	return view('pages.dashboard');
    }
}
