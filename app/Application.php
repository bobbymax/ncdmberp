<?php

namespace App;

use App\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Classes\Base;

class Application extends Model
{
	public function getRouteKeyName()
	{
		return 'code';
	}

    public function modules()
    {
        return $this->hasMany(Module::class);
    }

    public function departments()
    {
    	return $this->belongsToMany(Department::class, 'application_department');
    }

    public function allocateAppTo(Department $department)
    {
    	return $this->departments()->save($department);
    }
}
