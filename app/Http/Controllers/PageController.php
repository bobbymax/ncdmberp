<?php

namespace App\Http\Controllers;

use App\Page;
use App\Module;
use App\Role;
use App\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Classes\Base;

class PageController extends Controller
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
    public function index(Module $module)
    {
        return view('pages.module-pages.index', compact('module'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Module $module)
    {
        $roles = Role::latest()->get();
        $departments = Department::latest()->get();
        return view('pages.module-pages.create', compact('module', 'roles', 'departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Module $module)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
            'route' => 'required|string|max:255',
            'menu' => 'required',
            'is_published' => 'required|integer',
        ]);


        $page = new Page;

        $page->name = $request->name;
        $page->label = Str::slug($request->name);
        $page->icon = $request->icon;
        $page->route = $request->route;
        $page->is_published = $request->is_published;
        $page->description = $request->description;
        $page->url = $request->url;
        $page->menu = $request->menu;

        if ($module->pages()->save($page)) {

            if ($request->has('roles')) {
                foreach ($request->roles as $role) {
                    $r = Role::find($role);

                    if ($r) {
                        $page->grantPageAccessTo($r);
                    }
                }
            }

            if ($request->has('departments')) {
                foreach ($request->departments as $department) {
                    $d = Department::find($department);

                    if ($d) {
                        $page->addPageAccessTo($d);
                    }
                }
            }

            $permissions = Base::generatePermissions($page->label, 'pages', 'page');
        }

        return redirect()->route('modules.show', [$module->application->code, $module->code])->with('status', 'Page created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Module $module, Page $page)
    {
        return view('pages.module-pages.show', compact('module', 'page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Module $module, Page $page)
    {
        $roles = Role::latest()->get();
        $departments = Department::latest()->get();
        $currentRoles = $page->roles->pluck('id')->toArray();
        $currentDepartments = $page->departments->pluck('id')->toArray();
        return view('pages.module-pages.edit', compact('module', 'page', 'roles', 'departments', 'currentRoles', 'currentDepartments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Module $module, Page $page)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
            'route' => 'required|string|max:255',
            'menu' => 'required',
            'is_published' => 'required|integer',
        ]);

        $oldName = $page->label;

        $page->name = $request->name;
        $page->label = Str::slug($request->name);
        $page->icon = $request->icon;
        $page->route = $request->route;
        $page->is_published = $request->is_published;
        $page->description = $request->description;
        $page->url = $request->url;
        $page->menu = $request->menu;

        if ($module->pages()->save($page)) {

            if ($request->has('roles')) {
                foreach ($request->roles as $role) {
                    $r = Role::find($role);
                    $currentRls = $page->roles->pluck('id')->toArray();
                    if ($r && !in_array($r->id, $currentRls)) {
                        $page->grantPageAccessTo($r);
                    }
                }
            }

            if ($request->has('departments')) {
                foreach ($request->departments as $department) {
                    $d = Department::find($department);
                    $currentDept = $page->departments->pluck('id')->toArray();
                    if ($d && !in_array($d->id, $currentDept)) {
                        $page->addPageAccessTo($d);
                    }
                }
            }

            $permissions = Base::checkPermissions($oldName, $page->label, 'pages', 'page');
        }

        return redirect()->route('modules.show', [$module->application->code, $module->code])->with('status', 'Page updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Module $module, Page $page)
    {
        $page->delete();
        return back()->with('status', 'Page deleted successfully.');
    }
}
