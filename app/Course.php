<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
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

    public function qualifications()
    {
    	return $this->belongsToMany(Qualification::class, 'course_qualification');
    }

    public function addQualification(Qualification $qualification)
    {
    	return $this->qualifications()->save($qualification);
    }

    public function currentQualifications()
    {
    	return $this->qualifications->pluck('id')->toArray();
    }
}
