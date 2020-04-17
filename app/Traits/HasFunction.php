<?php

namespace App\Traits;
use Illuminate\Support\Str;
use App\Classes\Base;
use App\Training;
use App\TrainingDetail;
use App\Nomination;
use Carbon\Carbon;
use App\User;
use App\Vocabulary;
use App\Department;

trait HasFunction
{
	public function loggedInStaff()
	{
		return auth()->user();
	}
	
	public function slugify($value)
	{
		return Str::slug($value);
	}
	
	public function parse($date)
	{
		return Base::dateParse($date);
	}

	public function volt(string $str) : int 
	{
		$vocabulary = Vocabulary::where('code', $str)->first();
		return is_object($vocabulary) ? $vocabulary->id : 3;
	}

	public function verifyExistance($value)
	{
		return Training::with('major')->where('label', $this->slugify($value))->first();
	}

	public function verifyByEmail($email)
	{
		return User::with('departments')->where('email', $email)->first();
	}

	public function splitStaffs($staffs)
	{
		return explode(",", $staffs);
	}

	public function getDepartment(User $staff)
	{
		return $staff->departments->where('vocabulary_id', $this->volt('dept'))->first();
	}

	public function loaders($str, $value)
	{
		$staff = User::where('staff_no', $str)->first();
		$detail =  TrainingDetail::find($value);

		return compact('staff', 'detail');
	}

	public function verifyRecord($staffID, $detailID)
	{
		$loaded = $this->loaders($staffID, $detailID);
		return Nomination::where('staff_id', $loaded['staff']['id'])->where('training_detail_id', $loaded['detail']['id'])->first();
	}
}