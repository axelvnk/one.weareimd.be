<?php
namespace api\v1;
class achievementController extends \BaseController {

	public function index()
	{
		$response = array("status" => "success", "achievements" => \Achievement::all());
		return \Response::json($response);
	}

	public function show($id)
	{
		$achievement = \Achievement::find($id);
		$response = array("status" => "success", "achievement" => $achievement);
		return \Response::json($response);
	}
}
