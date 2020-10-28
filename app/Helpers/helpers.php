<?php

use Illuminate\Support\Str;
use Carbon\Carbon;

function dateParser($value)
{
	$date = Carbon::parse($value);

	return $date->format('d M, Y');
}