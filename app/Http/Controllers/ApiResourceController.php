<?php

namespace App\Http\Controllers;

use App\ApiResource;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ApiResourceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apiResources = ApiResource::latest()->get();
        return view('modules.api-resources.index', compact('apiResources'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modules.api-resources.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'published' => 'required'
        ]);

        $resource = new ApiResource;

        $resource->name = $request->name;
        $resource->label = Str::slug($request->name);
        $resource->url = $request->url;
        $resource->published = $request->published;

        $resource->save();

        return redirect()->route('apiResources.index')->with('status', 'Api Resource created successfully.'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ApiResource  $apiResource
     * @return \Illuminate\Http\Response
     */
    public function show(ApiResource $apiResource)
    {
        return view('modules.api-resources.show', compact('apiResource'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ApiResource  $apiResource
     * @return \Illuminate\Http\Response
     */
    public function edit(ApiResource $apiResource)
    {
        return view('modules.api-resources.edit', compact('apiResource'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ApiResource  $apiResource
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ApiResource $apiResource)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'published' => 'required'
        ]);

        $apiResource->name = $request->name;
        $apiResource->label = Str::slug($request->name);
        $apiResource->url = $request->url;
        $apiResource->published = $request->published;

        $apiResource->save();

        return redirect()->route('apiResources.index')->with('status', 'Api Resource updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ApiResource  $apiResource
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApiResource $apiResource)
    {
        $apiResource->delete();
        return back()->with('status', 'Api Resource deleted successfully.');
    }
}
