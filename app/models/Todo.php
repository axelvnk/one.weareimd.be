<?php

class Todo extends Eloquent
{

    public function user()
    {
        return $this->belongsTo('User');
    }
}
