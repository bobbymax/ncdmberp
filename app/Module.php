<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
	public function getRouteKeyName()
	{
		return 'code';
	}

    public function application()
    {
    	return $this->belongsTo(Application::class);
    }

    public function pages()
    {
    	return $this->hasMany(Page::class);
    }

    public function hasChildren()
    {
        return $this->pages->where('is_published', 1);
    }

    public static function states()
    {
        return [
            1 => 'Yes',
            0 => 'No',
        ];
    }
}
