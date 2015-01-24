<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{

    public function up()
    {
        Schema::create('users', function ($table) {
            $table->increments('id');
            $table->string('password');
            $table->string('firstname');
            $table->string('name');
            $table->date('dateofbirth');
            $table->string('email');
            $table->string('class');
            $table->string('website');
            $table->string('about', 1000);
            $table->string('avatar');
            $table->boolean('admin')->default(false);
            $table->boolean('employer')->default(false);
            $table->timestamps();
            $table->rememberToken();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }

}
