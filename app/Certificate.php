<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    public function staff()
    {
    	return $this->belongsTo(User::class, 'staff_id');
    }

    public function parent()
    {
    	return $this->belongsTo(TrainingDetail::class, 'training_detail_id');
    }

    public function trainingIsConfirmed()
    {
        return $this->where('status', '!=', 'pending')->where('confirmed', 1)->first();
    }

    public function createOrUpdateFormat($user, $training, $value = null)
    {
    	$this->staff_id = $user->id;
    	$this->training_detail_id = $training->id;
    	$this->path = $value;

    	$this->save();

    	return $this;
    }
}
