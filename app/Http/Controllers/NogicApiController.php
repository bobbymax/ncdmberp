<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apis\NogicApi;
use App\ApiResource;

class NogicApiController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function redirectToGateway(ApiResource $resource)
    {
        $nogic = new NogicApi($resource);
        return $nogic->build()->fetch();
    }
}
