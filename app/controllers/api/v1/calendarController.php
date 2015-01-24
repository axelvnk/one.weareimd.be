<?php

namespace api\v1;

class calendarController extends \BaseController
{

    public function index()
    {
        $response = array("status" => "success", "events" => \Calendar::get());
        return \Response::json($response);
    }

    public function show($id)
    {
        $event = \Calendar::find($id);
        $response = array("status" => "success", "event" => $event);
        return \Response::json($response);
    }
}
