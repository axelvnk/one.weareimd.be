<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeasersTable extends Migration {

	public function up()
	{
        Schema::create('teasers', function($table)
        {
            $table->increments('id');
            $table->string('email');
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::dropIfExists('teasers');
	}
}
