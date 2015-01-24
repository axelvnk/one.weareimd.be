<?php

class PlanningController extends BaseController
{

    //CALENDAR CRUD

    public function add()
    {
        return View::make('events.addEvent');
    }

    public function create($id)
    {


        $user_planning = DB::table('eventplanning')
            ->where('user_id', '=', Auth::id())
            ->where('event_id', '=', $id)
            ->first();

        if (is_null($user_planning)) {
            $p = new Eventplanning;
            $p->user_id = Auth::id();
            $p->event_id = $id;
            $p->save();
        }
        return Redirect::back()->with('message', 'Evenement toegevoegd.');


    }

}

?>
