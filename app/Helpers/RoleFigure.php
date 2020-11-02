<?php

namespace App\Helpers;

use App\User;
use App\Role;
use App\Department;
use App\Traits\HasFunction;

class RoleFigure
{

	use HasFunction;

	// Fetch all nominated staff emails
	// Verify that the account exists in the database
	// Fetch the department of each nominee
	// Check for staff with manager role
	// Wrap in an array
	// Return results

	protected $staffs;

	protected $managers = [];

	protected $deptIds = [];

	public function __construct(array $staffs)
	{
		$this->staffs = $staffs;
	}

	private function getStaffs()
	{
		// Fetch all nominated staff emails
		foreach ($this->staffs as $staff) {
			// Verify that the account exists in the database
			if ($verified = $this->verify($staff)) {
				// Fetch the department of each nominee
				$this->deptIds[] = $verified->departments->where('vocabulary_id', $this->volt('dept'))->first()->id;
			}
		}

		return $this->deptIds;
	}

	private function addManager($email)
	{
		return $this->managers[] = $email;
	}

	private function isManager(User $staff) : bool
	{
		return $staff->hasRole('manager');
	}

	private function verify($email)
	{
		return User::where('email', $email)->first();
	}

	private function getDepartment($id)
	{
		return Department::find($id);
	}



}
