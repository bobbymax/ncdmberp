<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Grade extends Model
{
    public function vocabularies()
    {
    	return $this->hasMany(Vocabulary::class, 'executive');
    }

    public function createOrUpdateFormat(array $data)
    {
    	$this->name = $data['name'];
        $this->level = $data['level'];
        $this->label = Str::slug($data['name']);
        $this->save();
    }
}
