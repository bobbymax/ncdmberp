<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Department extends Model
{
    protected $guarded = [''];

    public function vocabulary()
    {
    	return $this->belongsTo(Vocabulary::class);
    }

    public function staffs()
    {
    	return $this->belongsToMany(User::class, 'department_user');
    }

    public function trainings()
    {
        return $this->belongsToMany(TrainingDetail::class, 'department_trainings');
    }

    public function applications()
    {
    	return $this->belongsToMany(Application::class, 'application_department');
    }

    public function pages()
    {
        return $this->belongsToMany(Page::class,  'department_page');
    }

    public function nominations()
    {
        return $this->hasMany(Nomination::class);
    }

    public function createOrUpdateFormat(array $data)
    {
        $this->vocabulary_id = $data['vocabulary_id'];
        $this->name = $data['name'];
        $this->label = Str::slug($data['name']);
        $this->code = strtoupper($data['code']);
        $this->parent = $data['parent'];
        $this->save();

        return $this;
    }
}
