<?php

namespace App\Traits;

trait RegularExpression
{

	public function loggedInStaff()
	{
		return auth()->user();
	}

}