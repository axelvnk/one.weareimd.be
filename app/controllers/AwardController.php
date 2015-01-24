<?php

class AwardController extends BaseController
{

    //AWARD CRUD

    public function show($id)
    {

    }

    public function listall()
    {
        $awards = Award::get();
        $data = array("keys" => array("id", "user_id", "xp"), "data" => $awards);
        $headers = array("#" => "10", "User ID" => "200", "Experience" => "200", "Actions" => "100");
        return View::make('admin.list')->with('data', $data)->with('headers', $headers)->with('title', 'Awards');
    }

    public function delete($id)
    {
        $award = Award::find($id);
        $award->delete();
        return Redirect::to('/admin/');
    }

    public function edit($id)
    {
        $award = Award::with('user')->find($id);
        return View::make('admin.awardAchievement', array('user' => $award->user));
    }

    public function store($id)
    {
        $award = Award::find($id);
        $award->xp = Input::get("experience");
        $award->save();
        return Redirect::to('/admin')->with('message', 'Award bijgewerkt');
    }

    public function add()
    {
        //$users = User::lists('name','id');
        $users = User::select(DB::raw('CONCAT(firstname, " ",name) AS user, id'))->lists('user', 'id');
        return View::make('admin.awardAchievement', array('users' => $users));
    }

    public function create()
    {
        $award = new Award;
        $award->user_id = Input::get("user");
        $award->xp = Input::get("experience");
        $award->save();
        return Redirect::to('/admin/award/add')->with('message', 'Achievement uitgedeeld.');
    }
}

