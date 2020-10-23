<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nugget extends Model
{
	protected $fillable = ['api_resource_id', 'key', 'display_name'];

    public function consumable()
    {
    	return $this->belongsTo(ApiResource::class, 'api_resource_id');
    }
}
