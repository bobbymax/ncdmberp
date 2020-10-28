<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasFunction;
use App\Classes\Base;
use App\User;
use App\Major;

class Training extends Model
{

    use HasFunction;

    protected $guarded = ['id'];

    public function getRouteKeyName()
    {
        return 'label';
    }

    /**
     *
     * Sponsors of Training
     * @return array [description]
     * 
     */
    public static function sponsors()
    {
    	$sponsors = [
    		'ncdmb' => 'NCDMB',
    		'previous-employer' => 'Previous Employer',
    		'personal' => 'Personal',
    	];

        $types = [
            'local' => 'Local',
            'international' => 'International',
            'virtual' => 'Virtual',
        ];

        return compact('sponsors', 'types');
    }

    public function displayColumns()
    {
        return [
            'title' => 'Training Title',
            'name' => 'Category',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'location' => 'Location',
            'resident' => 'Resident',
            'sponsor' => 'Sponsor',
            'vendor' => 'Provider'
        ];
    }

    public function details()
    {
        return $this->hasMany(TrainingDetail::class);
    }

    public function staffs()
    {
        return $this->belongsToMany(User::class, 'training_user');
    }

    public function addParticipant(User $staff)
    {
        return $this->staffs()->save($staff);
    }

    public function checkAndAddParticipant($staffID)
    {
        $staff = User::find($staffID);
        return $this->addParticipant($staff);
    }

    public function participants()
    {
        return $this->staffs->pluck('id')->toArray();
    }

    public function major()
    {
        return $this->belongsTo(Major::class, 'major_id');
    }

    protected function createOrUpdateMajor($str)
    {
        $major = Major::where('label', $this->slugify($str))->first();

        if (! $major) {
            $major = Major::create([
                'name' => $str,
                'label' => $this->slugify($str),
            ]);
        }

        return $major;
    }

    public function verify(array $data)
    {
        return $this->details->where('vendor', $data['vendor'])
                    ->where('start_date', $this->parse($data['start_date']))
                    ->where('end_date', $this->parse($data['end_date']))
                    ->first();
    }

    public function createOrUpdateFormat(array $data)
    {
        $major = $this->createOrUpdateMajor($data['major']);

        $this->major_id = $major->id;
        $this->title = $data['title'];
        $this->label = $this->slugify($data['title']);
        $this->save();

        return $this;
    }

}
