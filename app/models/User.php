<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface
{

    protected $table = 'users';
    protected $hidden = array('password', 'remember_token');

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    public function getReminderEmail()
    {
        return $this->email;
    }

    public function projects()
    {
        return $this->hasMany('Project');
    }

    public function awards()
    {
        return $this->hasMany('Award');
    }

    public function todos()
    {
        return $this->hasMany('Todo');
    }
}
