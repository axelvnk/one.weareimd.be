<?php
namespace api\v1;
class userController extends \BaseController {

	public function index()
	{
		$response = array("status" => "success", "users" => \User::get());
		return \Response::json($response);
	}

	/*public function show($id)
	{
		$user = \User::find($id);
		$response = array("status" => "success", "user" => $user);
		return \Response::json($response);
	}*/

	public function show($email)
	{
		$user = \User::where('email', $email)->get();
		$response = array("status" => "success", "user" => $user);
		return \Response::json($response);
	}
}
