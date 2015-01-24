<?php

Route::post('/projects/ajax_order', 'ProjectController@ajaxFilter');
Route::post('/students/ajax_search', 'UserController@ajaxSearch');
Route::post('/projects', 'ProjectController@filter');

Route::group(array('before' => 'guest'), function () {
    Route::post('/register', 'UserController@create');
    Route::post('/login', 'UserController@handleLogin');
    Route::get('/register', 'UserController@add');
    Route::get('/login', 'UserController@showLogin');
});

Route::group(array('before' => 'auth'), function () {

    Route::get('/todo', 'TodoController@show');

    //USER CONTROL

    Route::get('/profile/edit', 'UserController@showUpdate');
    Route::post('/profile/edit', 'UserController@store');

    //PROJECT CONTROL

    Route::get('/project/add', 'ProjectController@show');
    Route::post('/project/add', 'ProjectController@save');
    Route::post('/projects/ajax_vote', 'VoteController@ajaxVote');
    Route::post('/projects/ajax_unvote', 'VoteController@ajaxUnvote');
    Route::get('/projects/vote/{id}', 'VoteController@vote');
    Route::get('/projects/unvote/{id}', 'VoteController@unvote');
    Route::post('/projects/ajax_comment', 'CommentController@ajaxComment');
    Route::get('/comments/delete/{id}', 'CommentController@remove');
    Route::post('/projects/ajax_delete_comment', 'CommentController@ajaxRemove');
    Route::post('/projects/{id}', 'CommentController@comment');
    Route::get('/projects/delete/{id}', 'ProjectController@remove');
    Route::get('/projects/edit/{id}', 'ProjectController@showUpdate');
    Route::post('/projects/edit/{id}', 'ProjectController@update');


});

Route::group(array('prefix' => 'job', 'before' => 'auth|employee'), function () {
    Route::get('/add', 'JobController@employeeAdd');
    Route::post('/add', 'JobController@create');
});

Route::group(array('before' => 'auth|admin', 'prefix' => 'admin'), function () {

    //DEPLOY CONTROL
    Route::get('/deploy', 'DeployController@index');

    //USER CONTROL
    Route::get('/', 'UserController@showDashboard'); //make
    Route::get('/user', 'UserController@listall');
    Route::get('/user/edit/{id}', 'UserController@edit');
    Route::post('/user/edit/{id}', 'UserController@store');
    Route::get('/user/delete/{id}', 'UserController@delete');
    Route::get('/user/add', 'UserController@add');
    Route::post('/user/add', 'UserController@create');

    //PROJECT CONTROL
    Route::get('/project', 'ProjectController@listall');
    Route::get('/project/add', 'ProjectController@add');
    Route::post('/project/add', 'ProjectController@save');
    Route::get('/project/delete/{id}', 'ProjectController@delete');
    Route::get('/project/edit/{id}', 'ProjectController@edit');
    Route::post('/project/edit/{id}', 'ProjectController@store');

    //AWARD CONTROL
    Route::get('/award/', 'AwardController@listall');
    Route::get('/award/add', 'AwardController@add');
    Route::post('/award/add', 'AwardController@create');
    Route::get('/award/edit/{id}', 'AwardController@edit');
    Route::post('/award/edit/{id}', 'AwardController@store');
    Route::get('/award/delete/{id}', 'AwardController@delete');

    //EVENT CONTROL
    Route::get('/event', 'CalendarController@listall');
    Route::get('/event/add', 'CalendarController@add');
    Route::post('/event/add', 'CalendarController@create');
    Route::get('/event/edit/{id}', 'CalendarController@edit');
    Route::post('/event/edit/{id}', 'CalendarController@store');
    Route::get('/event/delete/{id}', 'CalendarController@delete');

    //JOB CONTROL
    Route::get('/job', 'JobController@listall');
    Route::get('/job/delete/{id}', 'JobController@delete');
    Route::get('/job/add', 'JobController@add');
    Route::post('/job/add', 'JobController@create');
    Route::get('/job/edit/{id}', 'JobController@edit');
    Route::post('/job/edit/{id}', 'JobController@store');
});

Route::group(array('prefix' => 'api/v1'), function () {
    Route::get('/jobs/load', 'api\v1\jobController@listMore');
    Route::get('/projects/load', 'api\v1\projectController@listMore');
    Route::resource('users', 'api\v1\userController');
    Route::resource('jobs', 'api\v1\jobController');
    Route::resource('events', 'api\v1\calendarController');
    Route::resource('achievements', 'api\v1\achievementController');
    Route::resource('projects', 'api\v1\projectController');
    Route::resource('todos', 'api\v1\todoController');
});

Route::get('/', 'HomeController@showIndex');
Route::get('/index', 'HomeController@showIndex');
Route::get('/calendar', 'CalendarController@showCalendar');
Route::get('/events', 'CalendarController@showall');
Route::get('/events/{id}', 'CalendarController@show');
Route::post('/events/{id}', 'PlanningController@create');
Route::get('/jobs', 'JobController@showDetailedList');
Route::get('/jobs/{id}', 'JobController@showDetailed');
Route::get('/projects', 'ProjectController@showall');

Route::get('/projects/{id}', 'ProjectController@showDetailed');
Route::get('/students', 'UserController@showall');
Route::get('/profile/{id?}', 'UserController@show');
Route::get('/logout', 'UserController@logout');
Route::get('/documentation', 'DocumentationController@show');
