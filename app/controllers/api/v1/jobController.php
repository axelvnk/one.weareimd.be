<?php
namespace api\v1;
class jobController extends \BaseController {

	public function index()
	{
		$response = array("status" => "success", "jobs" => \Job::get());
		return \Response::json($response);
	}

	public function show($id)
	{
		$job = \Job::find($id);
		$response = array("status" => "success", "job" => $job);
		return \Response::json($response);
	}

	public function listMore()
	{
		$start = \Input::get("start");
		$jobs = \Job::take(5)->skip($start)->get();
		$response = array("status" => "success", "jobs" => $jobs, "input" => \Input::all());
		return \Response::json($response);
	}
}
