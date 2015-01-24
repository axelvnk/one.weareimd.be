<?php

class TodoController extends BaseController
{

    public function show()
    {
        return View::make('users.todo');
    }

}
