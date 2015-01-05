<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventplanningTable extends Migration {

	public function up()
	{
        Schema::create('eventplanning', function($table)
        {
            $table->increments('id');
            $table->integer('user_id')->unsigned();

            $table->integer('event_id')->unsigned();

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('event_id')->references('id')->on('calendars')->onDelete('cascade');
        });
	}

	public function down()
	{
		Schema::dropIfExists('eventplanning');
	}

}
