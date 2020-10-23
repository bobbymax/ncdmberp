<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    protected $guarded = ['id'];

    public function getRouteKeyName()
	{
		return 'label';
	}

	public function trainings()
	{
		return $this->hasMany(TrainingDetail::class);
	}

	public function periodspan()
	{
		return "at least " . $this->period . " days";
	}

	public function courses()
    {
    	return $this->belongsToMany(Course::class, 'course_qualification');
    }
}
