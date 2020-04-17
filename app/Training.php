<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasFunction;
use App\Classes\Base;
use App\User;

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
        ];

        return compact('sponsors', 'types');
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

    public function verify(array $data)
    {
        return $this->details->where('vendor', $data['vendor'])
                    ->where('start_date', $this->parse($data['start_date']))
                    ->where('end_date', $this->parse($data['end_date']))
                    ->first();
    }

    public function createOrUpdateFormat(array $data)
    {
        $this->major_id = $data['major_id'];
        $this->title = $data['title'];
        $this->label = $this->slugify($data['title']);
        $this->save();

        return $this;
    }

}
