<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showIndex() {

		$users = User::orderBy('created_at', 'desc')->take(5)->get();
		$projects = Project::with('votes')->orderBy('created_at', 'desc')->take(3)->get();
		$events = Calendar::orderBy('startdate', 'desc')->take(5)->get();
		$jobs = Job::orderBy('created_at', 'desc')->take(5)->get();

        return View::make('users.index')
            ->with('users', $users)
            ->with('projects', $projects)
            ->with('events', $events)
            ->with('jobs', $jobs);

    }

	//TEASER

	public function showTeaser() {

		return View::make('users.teaser');

	}

	public function handleTeaser() {

		$v = Validator::make(Input::all(), array('email' => 'required|email|unique:teasers'));

		if ($v->fails())
		{
			return Redirect::to('/')->withErrors($v)->withInput(Input::all());
		} else {
			$teas = new Teaser;
			$teas->email = Input::get('email');
			$teas->save();

			return Redirect::to('/')->with('message','Thanks for signing!');
		}
	}

}
