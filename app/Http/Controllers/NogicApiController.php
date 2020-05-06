<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apis\NogicApi;
use App\ApiResource;

class NogicApiController extends Controller
{

	protected $data = [];

    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function redirectToGateway(ApiResource $resource)
    { 
        $response = (new NogicApi($resource))->build()->fetch();
        return view('modules.consumables.index', compact('response', 'resource'));

        // return $response;
    }

}
