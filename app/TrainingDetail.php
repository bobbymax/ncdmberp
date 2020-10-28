<?php

namespace App;

use App\Qualification;
use App\Certificate;
use App\Traits\HasFunction;
use App\Classes\Base;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Department;
use Image;

class TrainingDetail extends Model
{

	use HasFunction;

	protected $filename;
    protected $certificate_file;
	protected $dates = ['start_date', 'end_date'];
	protected const ARCHIVED = 1;
    protected const PENDING = 0;
    protected const A_STATE = "archived";
    protected const ACTION = "completed";

    public function training()
    {
    	return $this->belongsTo(Training::class, 'training_id');
    }

    public function departments()
    {
        return $this->belongsToMany(Department::class, 'department_trainings');
    }

    public function nominateDepartment(Department $department)
    {
        return $this->departments()->save($department);
    }

    public function currentDepartments()
    {
        return $this->departments->pluck('id')->toArray();
    }

    public function storeDepartment($deptID)
    {
        $department = Department::find($deptID);
        return $this->nominateDepartment($department);
    }

    public function qualification()
    {
        return $this->belongsTo(Qualification::class, 'qualification_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function staffs()
    {
    	return $this->belongsToMany(User::class, 'staff_trainings');
    }

    public function nominations()
    {
        return $this->hasMany(Nomination::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    public function addAttendee(User $staff)
    {
    	return $this->staffs()->save($staff);
    }

    public function checkAndAddAttendee($staffID)
    {
        $staff = User::find($staffID);
        return $this->addAttendee($staff);
    }

    public function attendees()
    {
    	return $this->staffs->pluck('id')->toArray();
    }

    public function responded()
    {
        return $this->nominations->where('state', '===', 'approved')->where('remark', '!=', null)->count();
    }

    public function nominated()
    {
        return $this->nominations->count();
    }

    public function duration()
    {
        $diff = Base::diffDays($this->start_date, $this->end_date);
        return $diff . " days"; 
    }

    public function lifecycle()
    {
        return $this->timeFormat();
    }

    public function fetchCertificate()
    {
        $cert = $this->certificates->where('staff_id', auth()->user()->id)->first();
        return is_object($cert) && $cert->path !== null ? ' disabled' : ''; 
    }

    public function verify(array $data)
    {
        return $this->where('vendor', $data['vendor'])
                    ->where('start_date', $this->parse($data['start_date']))
                    ->where('end_date', $this->parse($data['end_date']))
                    ->first();
    }

    protected function timeFormat()
    {
        if ($this->start_date->format('Y') === $this->end_date->format('Y')) {
            if ($this->start_date->format('M') === $this->end_date->format('M')) {
                return $this->start_date->format('d') . " - " . $this->end_date->format('d M, Y');
            } else {
                return $this->start_date->format('d M') . " - " . $this->end_date->format('d M, Y');
            }
        }

        return $this->start_date->format('d M, Y') . " - " . $this->end_date->format('d M, Y');
    }

    public function createOrUpdateFormat($training, array $data, $status="archived", $action="completed", $attention=true)
    {
    	// Persist to database
    	$this->training_id  = $training->id;
        $this->qualification_id = $this->getQualification($data['qualification_id']);
        $this->course_id = $data['course_id'];
        $this->vendor = $data['vendor'];
        $this->location = $data['location'];
        $this->start_date = $this->parse($data['start_date']);
        $this->end_date = $this->parse($data['end_date']);

        $this->sponsor = $data['sponsor'];
        $this->resident = $data['resident'];
        $this->status = $status;
        $this->action = $action;
        $this->completed = ! $attention ? self::PENDING : self::ARCHIVED;

        if ($this->save()) {

            if (isset($data['certificate'])) {
                $this->certificate_file = $data['certificate'];
                // $this->addCertificate($this->certificate_file);
            }

            $certificate = Certificate::where('staff_id', auth()->user()->id)->where('training_detail_id', $this->id)->first();

            if (! $certificate) {
                $certificate = new Certificate;   
            }
            
            $certificate->createOrUpdateFormat(auth()->user(), $this, $this->certificate_file);
        }

        return $this;
    }

    protected function getQualification($value)
    {
        $qualification = Qualification::where('label', $this->slugify($value))->first();
        return is_object($qualification) ? $qualification->id : 1;
    }

    public function addCertificate($data)
    {
		$file = $data;
		$this->filename = time() . $file->getClientOriginalName();
		$location = public_path('images/certificates/' . $this->filename);
		Image::make($file)->fit(1280, 820)->save($location);

		return $this->filename;
    }
}
