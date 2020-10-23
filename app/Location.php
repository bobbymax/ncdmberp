<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Location extends Model
{
	public const OPENED = 1;
	public const CLOSED  = 0;
    public function createOrUpdateFormat(array $data)
    {
    	$this->name = $data['name'];
        $this->label = Str::kebab($data['name']);
        $this->state = $data['state'];
        $this->inCommission = isset($data['inCommission']) ? $data['inCommission'] : self::OPENED;
        $this->save();

        return $this;
    }
}
