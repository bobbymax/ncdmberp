<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nomination extends Model
{

    public const APPROVED = 1;

    public const DECLINED = 0;

    public function staff()
    {
    	return $this->belongsTo(User::class, 'staff_id');
    }

    public function department()
    {
    	return $this->belongsTo(Department::class, 'department_id');
    }

    public function detail()
    {
    	return $this->belongsTo(TrainingDetail::class, 'training_detail_id');
    }

    public function decisions()
    {
        return [
            'approved' => 'Approve',
            'declined' => 'Decline'
        ];
    }

    public function approval(array $data)
    {
        $this->remark = $data['remark'];
        $this->state = $data['approval'];
        $this->flow = "hr";
        $this->approval = $data['approval'] == "approved" ? self::APPROVED : self::DECLINED;

        $this->save();

        return $this;
    }

    public function createOrUpdateFormat($staff, $training, $department)
    {
        $this->staff_id = $staff->id;
        $this->training_detail_id = $training->id;
        $this->department_id = $department->id;

        $this->save();

        return $this;
    }
}
