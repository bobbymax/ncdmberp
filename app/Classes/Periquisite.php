<?php

namespace App\Classes;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Grade;
use App\Location;
use App\Role;
use App\Permission;
use App\Vocabulary;
use App\Department;
use App\User;

class Periquisite
{

	public static function install($entity, $instance)
	{
		$results = self::getData()[$entity];
		foreach ($results as $data) {
			$datavalue = self::getInstance($instance);
			$datavalue->createOrUpdateFormat($data);
		}
	}

	private static function models()
	{ 
		return [
			'Grade' => Grade::class,
			'Role' => Role::class,
			'Location' => Location::class,
			'Vocabulary' => Vocabulary::class,
			'Department' => Department::class,
			'User' => User::class,
		];
	}

	private static function getInstance($value)
	{
		$instance = self::models();
		return new $instance[$value];
	}

	private static function getData()
	{
		$grades =  [ 
			[ 'name' => 'Officer III', 'level' => 'SS7' ],
            [ 'name' => 'Officer II', 'level' => 'SS6' ],
            [ 'name' => 'Officer I', 'level' => 'SS5' ],
            [ 'name' => 'Senior Officer', 'level' => 'SS4' ],
            [ 'name' => 'Supervisor', 'level' => 'SS3' ],
            [ 'name' => 'Senior Supervisor', 'level' => 'SS2' ],
            [ 'name' => 'Chief Officer', 'level' => 'SS1' ],
            [ 'name' => 'Deputy Manager', 'level' => 'M6' ],
            [ 'name' => 'Manager', 'level' => 'M5' ],
            [ 'name' => 'General Manager', 'level' => 'M4' ],
            [ 'name' => 'Director', 'level' => 'M3' ],
            [ 'name' => 'Executive Secretary', 'level' => 'M2' ],
        ];

        $roles = [
        	[ 'name' => 'Administrator' ],
        	[ 'name' => 'Staff' ],
        	[ 'name' => 'User' ],
        ];

        $locations = [
        	['name' => 'Opolo', 'state' => 'Bayelsa'],
        	['name' => 'Onopa', 'state' => 'Bayelsa'],
        	['name' => 'Central Business District', 'state' => 'Abuja'],
        ];

        $vocabularies = [
        	[
        		'name' => 'Directorate', 
        		'code' => 'dir', 
        		'executive' => self::getExecutive('Grade', 'director'),
        	],
        	['name' => 'Division', 'code' => 'div', 'executive' => self::getExecutive('Grade', 'general-manager')],
        	['name' => 'Department', 'code' => 'dept', 'executive' => self::getExecutive('Grade', 'manager')],
        	['name' => 'Unit', 'code' => 'unit', 'executive' => self::getExecutive('Grade', 'supervisor')],
        ];

        $departments  = [
        	[
        		'name' => 'Executive Secretary Office', 
        		'vocabulary_id' => self::getExecutive('Vocabulary', 'directorate'),
        		'code' => 'eso',
        		'parent' => 0,
        	],
        	[
        		'name' => 'Information Communication Technology', 
        		'vocabulary_id' => self::getExecutive('Vocabulary', 'department'),
        		'code' => 'ict',
        		'parent' => 1,
        	],
        ];

        $administrators = [
        	[
	        	'name' => 'Ekaro, Bobby Tamunotonye',
	        	'staff_no' => '18290',
	        	'email' => 'bobby.ekaro@ncdmb.gov.ng',
	        	'password' => Hash::make('password'),
	        	'grade_level' => 'SS5',
	        	'mobile' => '08094836184',
	        	'location' => 'Onopa',
	        	'type' => 'permanent',
	        	'office_no' => '305',
	        	'status' => 'available',
	        	'departments' => [1, 2],
	        	'roles' => [1, 2],
        	],
        ];

        return compact('grades', 'roles', 'locations', 'vocabularies', 'departments', 'administrators');
	}

	private static function getExecutive($model, $executive)
	{
		$fetcher = self::models();
		$object = $fetcher[$model]::where('label', $executive)->first();
		return is_object($object) ? $object->id : 1;
	}

	private static function storeGrades()
	{
		foreach (self::getGradeLevels() as $value) {
			$grade = new Grade;
			$grade->createOrUpdateFormat($value);
		}
	}


}