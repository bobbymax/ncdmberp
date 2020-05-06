<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiResource extends Model
{
    public function getRouteKeyName()
    {
        return 'label';
    }

    public function nuggets()
    {
    	return $this->hasMany(Nugget::class);
    }

    public function browseable()
    {
    	return $this->nuggets->where('browse', 1)->where('deny', 0);
    }
}
