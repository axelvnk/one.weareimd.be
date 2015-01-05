<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAwardedTable extends Migration {

	public function up()
	{
        Schema::create('awards', function($table)
        {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
			$table->integer('xp');

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
	}

	public function down()
	{
		Schema::dropIfExists('awards');
	}

}
