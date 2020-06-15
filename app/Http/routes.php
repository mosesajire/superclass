<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
Route::get('/users/{id}/{name}', function($id, $name) {
	return "This is user {$name} with id $id";
});
*/

// Pages
Route::get('/', 'PagesController@index');

Route::get('/dashboard', 'PagesController@dashboard');

Route::get('/about', 'PagesController@about');

// Posts
Route::get('/posts', 'PostsController@index');
Route::get('/posts/{id}', 'PostsController@show');


Route::auth();

// Admin users
Route::group(
	array(
		'prefix' => 'admin',
		'namespace' => 'Admin',
		'middleware' => 'admin'
		),
	function () {
		// Categories
		Route::resource('categories', 'CategoriesController');

		// Roles
		Route::get('roles', 'RolesController@index');
		Route::get('roles/create', 'RolesController@create');
		Route::post('roles/create', 'RolesController@store');

		// Dashboard
		Route::get('/dashboard', 'DashboardController@index');
		Route::get('/', 'DashboardController@index');

		// Profile
		Route::get('/profile', 'ProfilesController@index');
		Route::get('/profile/{id}', 'ProfilesController@show');
		Route::get('/profile/{id}/edit', 'ProfilesController@edit');
		Route::put('/profile/{id}/edit', 'ProfilesController@update');

		// Posts
		Route::resource('posts', 'PostsController');

		Route::get('/posts/{user_id}', 'PostsController@userPost');


		// Images
		Route::resource('images', 'ImagesController');

		// Users
		Route::resource('users', 'UsersController');

	});

// Logged-in users
Route::group(
	array(
		'prefix' => 'user',
		'namespace' => 'User',
		'middleware' => 'auth'
		),
	function () {

		// Dashboard
		Route::get('/dashboard', 'DashboardController@index');

		Route::get('/', 'DashboardController@index');

		// Profile
		Route::get('/profile', 'ProfilesController@index');
		Route::get('/profile/{id}', 'ProfilesController@show');
		Route::get('/profile/{id}/edit', 'ProfilesController@edit');
		Route::put('/profile/{id}/edit', 'ProfilesController@update');

		// Images
		Route::resource('images', 'ImagesController');

		// Subjects
		Route::resource('subjects', 'SubjectsController');

		// Lessons
		Route::resource('lessons', 'LessonsController');

		// Topics
		Route::resource('topics', 'TopicsController');

		// Packages
		Route::resource('packages', 'PackagesController');

		// Enrolment
		Route::resource('enrolments', 'EnrolmentsController');

	});


// Examination Routes


Route::group(
	array(
		'prefix' => 'exams',
		'middleware' => 'auth'
		),
	function () {

		// Dashboard
		Route::get('/', 'QuestionsController@index');

		Route::get('/questions/start', 'QuestionsController@takeExam');
		Route::post('/questions/start', 'QuestionsController@storeResponse');

		// View submissions
		Route::get('/questions/check', 'QuestionsController@checkSubmission');

		Route::get('/questions/create', 'QuestionsController@create');

		Route::post('/questions/create', 'QuestionsController@storeQuestion');

		Route::get('questions/view', 'QuestionsController@view');

		Route::get('questions/{id}/edit', 'QuestionsController@edit');
		Route::put('questions/{id}/edit', 'QuestionsController@update');

		Route::get('questions/mark', 'QuestionsController@mark');

		Route::post('questions/mark/{user_id}', 'QuestionsController@markQuestions');

		// Students
		Route::resource('students', 'StudentsController');
	});


// Educators

Route::group(
	array(
		'prefix' => 'educators',
		'middleware' => 'auth'
		),
	function () {
		// Packages
		Route::resource('packages', 'Educator\PackagesController');

		// Subjects
		Route::resource('subjects', 'Educator\SubjectsController');

		// Lessons
		Route::resource('lessons', 'Educator\LessonsController');

		// Topics
		Route::resource('topics', 'Educator\TopicsController');

		// Participants
		Route::resource('enrolments', 'Educator\EnrolmentsController');
	});