<?php
namespace api\v1;
class todoController extends \BaseController
{

    public function index()
    {
        $response = array("status" => "success", "todos" => \Todo::get());
        return \Response::json($response);
    }

    public function show($id)
    {
        $todo = \Todo::with('user')->where('user_id', $id)->get();
        $response = array("status" => "success", "todo" => $todo);
        return \Response::json($response);
    }

    public function update($id)
    {
        $todo = \Todo::find($id);
        $todo->done = !$todo->done;
        $todo->save();
        return \Response::json(array('success' => true, 'todo' => $todo));
    }

    public function store()
    {
        $todo = new \Todo();
        $todo->todo = \Input::get("todo");
        $todo->description = \Input::get("description");
        $todo->done = false;
        $todo->user_id = \Auth::id();
        $todo->save();
        return \Response::json(array('success' => true, 'todos' => $todo));
    }

    public function destroy($id)
    {
        $removed = \Todo::destroy($id);
        return \Response::json(array('success' => $removed));
    }

}
