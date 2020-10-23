<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use PDF;

class ExportController extends Controller
{
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
}
