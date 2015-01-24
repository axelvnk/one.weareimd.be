<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{

    public function up()
    {
        Schema::create('jobs', function ($table) {
            $table->increments('id');
            $table->string('functie');
            $table->text('beschrijving');
            $table->string('adres');
            $table->string('gemeente');
            $table->string('postcode');
            $table->string('werkgever');
            $table->string('email');
            $table->string('telefoon');
            $table->string('logo');
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('jobs');
    }

}
