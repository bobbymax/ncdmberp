<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::prefix('dashboard')->group(function() {

	Route::get('nogic/resources/{resource}/fetch', 'NogicApiController@redirectToGateway')->name('fetch.resource');
	Route::get('trainings/callback', 'NogicApiController@handleGatewayCallback');

	// Tasks
	Route::resource('tasks', 'TaskController');
	Route::resource('milestones', 'MilestoneController');

	// Trainings
	Route::get('autocomplete', 'AjaxFormController@autocomplete')->name('autocomplete');
	Route::post('populate/major', 'AjaxFormController@major')->name('populate.existing');
	Route::post('dependencies', 'AjaxFormController@reveal')->name('get.dependencies');
	Route::post('get/staffs', 'AjaxFormController@loadStaffs')->name('get.staffs');
	Route::get('print/staffs/{staff}/trainings', 'ExportController@trainings')->name('print.trainings');

	// L & D Officer Controller Section
	Route::get('proposals', 'AdminController@suggested')->name('proposals');
	Route::get('confirm/{training}/category', 'AdminController@confirmCategory')->name('confirm.category');
	Route::get('uncategorised/trainings', 'AdminController@uncategorisedTrainings')->name('uncategorise.trainings');

	// Nominations Settings
	Route::get('remove/{staff}/from/{training}', 'AdminController@retract')->name('remove.staff.nomination');
	Route::get('schedule/{detail}/nominations', 'AdminController@schedule')->name('schedule.training');
	Route::post('nominations/{nomination}/decision', 'NominationController@makeDecision')->name('nomination.decision');
	Route::get('hr/nominations/{nomination}/show', 'NominationController@hrShow')->name('hr.show.nominations');
	Route::get('manage/nominations', 'NominationController@manage')->name('manage.nominations');
	Route::get('hr/nominations', 'NominationController@nominations')->name('hr.nominations');
	Route::resource('nominations', 'NominationController');
	
	// Staff Controller Section
	Route::get('training/details/{detail}/attendee', 'AjaxFormController@addAttendeeToClass')->name('add.attendee');
	Route::resource('trainings/{training}/details', 'TrainingDetailController');
	Route::resource('trainings', 'TrainingController');
	Route::resource('majors', 'MajorController');
	Route::resource('courses', 'CourseController');
	Route::resource('qualifications', 'QualificationController');

	Route::get('/', 'DashboardController@index')->name('user.dashboard');
});


Route::prefix('admin')->group(function() {
	Route::resource('apiResources', 'ApiResourceController');
	Route::resource('{module}/pages', 'PageController');
	Route::resource('{application}/modules', 'ModuleController');
	Route::resource('groups', 'GroupController');
	Route::resource('applications', 'ApplicationController');
	Route::resource('roles', 'RoleController');
	Route::resource('departments', 'DepartmentController');
	Route::resource('vocabularies', 'VocabularyController');
	Route::resource('staffs', 'StaffController');
	Route::resource('locations', 'LocationController');
	Route::resource('grades', 'GradeController');

	Route::get('/', 'DashboardController@index')->name('user.dashboard');
});
