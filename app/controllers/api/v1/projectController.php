<?php
namespace api\v1;
class projectController extends \BaseController
{

    public function index()
    {
        $response = array("status" => "success", "projects" => \Project::get());
        return \Response::json($response);
    }

    public function show($id)
    {
        $project = \Project::find($id);
        $response = array("status" => "success", "project" => $project);
        return \Response::json($response);
    }

    public function listMore()
    {
        $start = \Input::get("start");
        $projects = \Project::orderBy('created_at', 'desc')->with('user')->with('votes')->with('comments')->take(6)->skip($start)->get();
        $response = array("status" => "success", "projects" => $projects, "input" => \Input::all());
        return \Response::json($response);
    }
}
