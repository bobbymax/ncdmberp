<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Image;

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
    	$this->path = $value !== null ? $this->addCertificate($value) : null;
    	$this->save();

    	return $this;
    }

    public function addCertificate($data)
    {
        $file = $data;
        $filename = time() . $file->getClientOriginalName();
        $location = public_path('images/certificates/' . $filename);
        Image::make($file)->fit(1280, 820)->save($location);

        return $filename;
    }
}
