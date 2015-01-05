<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotesTable extends Migration {

	public function up()
	{
		Schema::create('votes', function($table){
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('project_id')->unsigned();
			$table->timestamps();

			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
		});
	}

	public function down()
	{
		Schema::dropIfExists('votes');
	}

}
