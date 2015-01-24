<?php

class Eventplanning extends Eloquent
{
    protected $table = 'eventplanning';

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function calendar()
    {
        return $this->belongsTo('Calendar');
    }
}
