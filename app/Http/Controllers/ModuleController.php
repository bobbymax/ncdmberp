<?php

namespace App\Http\Controllers;

use App\Module;
use App\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Classes\Base;
use Image;

class ModuleController extends Controller
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
    public function index(Application $application)
    {
        return view('pages.modules.index', compact('application'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Application $application)
    {
        return view('pages.modules.create', compact('application'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Application $application)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'path' => 'required',
        ]);

        $module = new Module;

        $module->name = $request->name;
        $module->label = Str::slug($request->name);
        $module->code = $request->code;
        $module->icon = $request->icon;
        $module->description = $request->description;

        if ($request->hasFile('path')) {
            $file = $request->file('path');
            $filename = time() . $file->getClientOriginalName();
            $location = public_path('images/applications/logos/' . $filename);
            Image::make($file)->fit(100, 100)->save($location);

            $module->path = $filename;
        }

        if ($application->modules()->save($module)) {
            $permissions = Base::generatePermissions($module->code, 'module', 'modules');
        }

        return redirect()->route('applications.show', $application->code)->with('status', 'Module created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function show(Application $application, Module $module)
    {
        return view('pages.modules.show', compact('application', 'module'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function edit(Application $application, Module $module)
    {
        $states = Module::states();
        return view('pages.modules.edit', compact('application', 'module', 'states'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Application $application, Module $module)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'active' => 'required',
        ]);

        $oldCode = $module->code;

        $module->name = $request->name;
        $module->label = Str::slug($request->name);
        $module->code = $request->code;
        $module->icon = $request->icon;
        $module->description = $request->description;
        $module->active = $request->active;

        if ($request->hasFile('path')) {
            $file = $request->file('path');
            $filename = time() . $file->getClientOriginalName();
            $location = public_path('images/applications/logos/' . $filename);
            Image::make($file)->fit(100, 100)->save($location);

            $module->path = $filename;
        }

        if ($application->modules()->save($module)) {
            $permissions = Base::checkPermissions($oldCode, $module->code, 'modules', 'module');
        }

        return redirect()->route('applications.show', $application->code)->with('status', 'Module updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function destroy(Application $application, Module $module)
    {
        $module->delete();
        return back()->with('status', 'Module has been deleted successfully.');
    }
}
