<?php

namespace App\Http\Controllers;

use App\Application;
use App\Permission;
use App\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Classes\Base;
use Image;

class ApplicationController extends Controller
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
        $applications = Application::latest()->get();
        return view('pages.applications.index', compact('applications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::latest()->get();
        return view('pages.applications.create', compact('departments'));
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
            'code' => 'required|string|max:255',
        ]);

        $application = new Application;

        $application->name = $request->name;
        $application->label = Str::slug($request->name);
        $application->code = $request->code;
        $application->icon = $request->icon;
        $application->description = $request->description;

        if ($request->hasFile('path')) {
            $file = $request->file('path');
            $filename = time() . $file->getClientOriginalName();
            $location = public_path('images/applications/logos/' . $filename);
            Image::make($file)->fit(150, 150)->save($location);

            $application->path = $filename;
        }

        if ($application->save()) {
            if ($request->has('departments')) {
                foreach ($request->departments as $department) {
                    $d = Department::find($department);

                    if ($d) {
                        $application->allocateAppTo($d);
                    }
                }
            }

            $permissions = Base::generatePermissions($application->code, 'applications', 'application');
        }

        return redirect()->route('applications.index')->with('status', 'Application created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function show(Application $application)
    {
        return view('pages.applications.show', compact('application'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function edit(Application $application)
    {
        $departments = Department::latest()->get();
        $currentDepartments = $application->departments->pluck('id')->toArray();
        return view('pages.applications.edit', compact('application', 'departments', 'currentDepartments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Application $application)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'active' => 'required',
        ]);

        $oldCode = $application->code;

        $application->name = $request->name;
        $application->label = Str::slug($request->name);
        $application->code = $request->code;
        $application->icon = $request->icon;
        $application->description = $request->description;
        $application->active = $request->active;

        if ($request->hasFile('path')) {
            $file = $request->file('path');
            $filename = time() . $file->getClientOriginalName();
            $location = public_path('images/applications/logos/' . $filename);
            Image::make($file)->fit(300, 300)->save($location);

            $application->path = $filename;
        }

        if ($application->save()) {
            if ($request->has('departments')) {
                foreach ($request->departments as $department) {
                    $d = Department::find($department);
                    $currentDepts = $application->departments->pluck('id')->toArray();
                    if ($d && !in_array($d->id, $currentDepts)) {
                        $application->allocateAppTo($d);
                    }
                }
            }

            $permissions = Base::checkPermissions($oldCode, $application->code, 'applications', 'application');
        }

        return redirect()->route('applications.index')->with('status', 'Application updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function destroy(Application $application)
    {
        $application->delete();
        return back()->with('status', 'Application deleted successfully.');
    }
}
