<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Hash;
use App\Traits\HasFunction;
use App\Classes\Base;
use Carbon\Carbon;
use App\Department;
use App\Role;
use App\Group;
use Image;


class User extends Authenticatable
{
    use Notifiable, HasFunction;

    public const STATE_DEFAULT = "available";

    protected $filename;

    protected $result;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'staff_no', 'grade_level', 'mobile', 'location', 'type', 'office_no', 'status', 'avatar', 'date_joined', 'active', 'password',
    ];

    protected $dates = ['date_joined'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getRouteKeyName()
    {
        return 'staff_no';
    }

    public function departments()
    {
        return $this->belongsToMany(Department::class, 'department_user');
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class, 'staff_id');
    }

    public function trainings()
    {
        return $this->belongsToMany(Training::class, 'training_user');
    }

    public function details()
    {
        return $this->belongsToMany(TrainingDetail::class, 'staff_trainings');
    }

    public function printable()
    {
        return $this->details->where('categorised', 1)->sortByDesc('start_date');
    }

    public function hierarchy()
    {
        $directorate = $this->department('dir');
        $division = $this->department('div');
        $department = $this->department('dept');

        $hasDivision =  $division !== null ? $division . "/" : '';

        return $directorate . "/" . $hasDivision . $department;
    }

    public function deptID()
    {
        return $this->departments->where('vocabulary_id', $this->volt('dept'))->first()->id;
    }

    public function department($str)
    {
        $this->result = $this->departments->where('vocabulary_id', $this->volt($str))->first();
        return is_object($this->result) ? $this->result->code : null;
    }

    public function uncategorisedTrainings()
    {
        return $this->trainings->where('state', 'archived')->where('action', 'completed')->where('status', 0);
    }

    public function proposedTrainings()
    {
        return $this->trainings->where('state', 'proposed');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function nominations()
    {
        return $this->hasMany(Nomination::class, 'staff_id');
    }

    public function actAs(Role $role)
    {
        return $this->roles()->save($role);
    }

    public function joinDepartment(Department $department)
    {
        return $this->departments()->save($department);
    }

    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('label', $role);
        }

        foreach ($role as $r) {
            if ($this->hasRole($r->label)) {
                return true;
            }
        }

        return false;
    }

    public function currentRoles()
    {
        return $this->roles->pluck('id')->toArray();
    }

    public function currentDepartments()
    {
        return $this->departments->pluck('id')->toArray();
    }

    public function belongsToDepartment($department)
    {
        if (is_string($department)) {
            return $this->departments->contains('label', $department);
        }

        foreach ($department as $d) {
            if ($this->belongsToDepartment($d->label)) {
                return true;
            }
        }

        return false;
    }

    public function createOrUpdateFormat(array $data, $password=true)
    {
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->staff_no = $data['staff_no'];
        $this->grade_level = $data['grade_level'];
        $this->location = $data['location'];
        $this->mobile = $data['mobile'];
        $this->office_no = $data['office_no'];
        $this->type = $data['type'];
        if ($password === true) {
            $this->password = Hash::make('Password1');
        }
        $this->date_joined = isset($data['date_joined']) ? Carbon::parse($data['date_joined']) : null;
        $this->status = isset($data['status']) ? $data['status'] : self::STATE_DEFAULT;

        if (isset($data['avatar'])) {
            $this->avatar = $this->addPhoto($data['avatar']);
        }

        if ($this->save()) {
            if (isset($data['departments'])) {
                foreach ($data['departments'] as $department) {
                    if ($department !== 0) {
                        $d = Department::find($department);
                        if ($d && !in_array($d->id, $this->currentDepartments())) {
                            $this->joinDepartment($d);
                        }
                    }
                }
            }

            if (isset($data['roles'])) {
                foreach ($data['roles'] as $role) {
                    if ($role !== null) {
                        $r = Role::find($role);
                        if ($r && !in_array($r->id, $this->currentRoles())) {
                            $this->actAs($r);
                        }
                    }
                }
            }
        }

        return $this;
    }

    public function addPhoto($data)
    {
        $file = $data;
        $this->filename = time() . $file->getClientOriginalName();
        $location = public_path('images/staffs/' . $this->filename);
        Image::make($file)->fit(300, 300)->save($location);

        return $this->filename;
    }

    public function trainingsCounter($str)
    {
        return $this->details->where('resident', $str)->count();
    }

    public function percentageTraining($str)
    {
        $counter = $this->trainingsCounter($str);
        $trainings = $this->details->count();

        $percent = ($counter / $trainings) * 100;

        return round($percent, 2) . "%";
    }

    public function isAdministrator()
    {
        return $this->roles->contains('label', Base::ADMINISTRATOR);
    }
}
