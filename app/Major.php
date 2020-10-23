<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Major extends Model
{

	protected const ACTIVE = 1;
	protected const NOT_ACTIVE = 1;

    protected $guarded = ['id'];

    public function getRouteKeyName()
	{
		return 'label';
	}

    public function trainings()
    {
        return $this->hasMany(Training::class);
    }

    public function state()
    {
    	return $this->active === self::ACTIVE ? 'Active' : 'Not Active';
    }
}
