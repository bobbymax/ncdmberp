<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public function getRouteKeyName()
	{
		return 'label';
	}

	public function module()
	{
		return $this->belongsTo(Module::class, 'module_id');
	}

	public function roles()
	{
		return $this->belongsToMany(Role::class, 'page_role');
	}

	public function grantPageAccessTo(Role $role)
	{
		return $this->roles()->save($role);
	}

	public function departments()
    {
        return $this->belongsToMany(Department::class,  'department_page');
    }

    public function addPageAccessTo(Department $department)
    {
    	return $this->departments()->save($department);
    }
}
