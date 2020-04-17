<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    public function staff()
    {
    	return $this->belongsTo(User::class, 'staff_id');
    }

    public function training()
    {
    	return $this->belongsTo(TrainingDetail::class, 'training_detail_id');
    }

    public function createOrUpdateFormat($user, $training, $value)
    {
    	$this->staff_id = $user->id;
    	$this->training_detail_id = $training->id;
    	$this->path = $value;

    	$this->save();

    	return $this;
    }
}
