<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApiResource extends Model
{
    public function getRouteKeyName()
    {
        return 'label';
    }
}
