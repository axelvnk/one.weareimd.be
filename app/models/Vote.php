<?php

Class Vote extends Eloquent{

	public function user(){
		return $this->belongsTo('User');
	}
	public function project(){
		return $this->belongsTo('Project');
	}

}
