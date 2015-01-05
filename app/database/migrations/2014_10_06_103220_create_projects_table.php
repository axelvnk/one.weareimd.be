<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration {

	public function up()
	{
		Schema::create('projects', function($table)
        {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->string('image');
            $table->string('category');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::dropIfExists('projects');
	}

}
