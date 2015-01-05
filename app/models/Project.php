<?php

class Project extends Eloquent {
    protected $table = 'projects';

	    public function user()
	    {
	        return $this->belongsTo('User');
	    }
	    public function votes()
	    {
	        return $this->hasMany('Vote');
	    }
	    public function comments()
	    {
	        return $this->hasMany('Comment')->orderBy('created_at', 'desc');
	    }
}
