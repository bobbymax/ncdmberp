<?php

namespace App\Http\Controllers;

use App\User;
use App\Location;
use App\Grade;
use App\Department;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Image;

class StaffController extends Controller
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
        $staffs = User::latest()->get();
        return view('pages.users.index', compact('staffs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locations = Location::latest()->get();
        $grades = Grade::latest()->get();
        $departments = Department::latest()->get();
        $roles = Role::latest()->get();
        return view('pages.users.create', compact('locations', 'grades', 'departments', 'roles'));
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
            'email' => 'required|email|string|max:255|unique:users',
            'staff_no' => 'required|integer',
            'grade_level' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'mobile' => 'required|unique:users',
            'office_no' => 'required|integer',
            'type' => 'required|string|max:255',
        ]);

        $staff = new User;
        $staff->createOrUpdateFormat($request->all());
        return redirect()->route('staffs.index')->with('status', 'Staff record has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $staff)
    {
        return view('pages.users.profile', compact('staff'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $staff)
    {
        $locations = Location::latest()->get();
        $grades = Grade::latest()->get();
        $departments = Department::latest()->get();
        $roles = Role::latest()->get();
        $currentDepartments = $staff->currentDepartments();
        $currentRoles = $staff->currentRoles();

        return view('pages.users.edit', compact('staff', 'locations', 'grades', 'departments', 'roles', 'currentDepartments', 'currentRoles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $staff)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|string|max:255',
            'staff_no' => 'required|integer',
            'grade_level' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'mobile' => 'required',
            'office_no' => 'required|integer',
            'type' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        $staff->createOrUpdateFormat($request->all(), false);

        return redirect()->route('staffs.index')->with('status', 'Staff record has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $staff)
    {
        $staff->delete();
        return back()->with('status', 'Staff records deleted successfully.');
    }
}
