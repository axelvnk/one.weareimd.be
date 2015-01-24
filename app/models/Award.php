<?php

class Award extends Eloquent
{

    public function user()
    {
        return $this->belongsTo('User');
    }

}
