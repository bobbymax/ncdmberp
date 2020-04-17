<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Vocabulary extends Model
{

	public const ACTIVE_DEFAULT = 1;

    public function departments()
    {
    	return $this->hasMany(Department::class);
    }

    public function management()
    {
    	return $this->belongsTo(Grade::class, 'executive');
    }

    public function createOrUpdateFormat(array $data)
    {
    	$this->name = $data['name'];
        $this->executive = $data['executive'];
        $this->code = $data['code'];
        $this->label = Str::slug($data['name']);
        $this->active = isset($data['active']) ? $data['active'] : self::ACTIVE_DEFAULT;
        $this->save();

        return $this;
    }
}
