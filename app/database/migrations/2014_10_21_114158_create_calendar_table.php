<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCalendarTable extends Migration
{

    public function up()
    {
        Schema::create('calendars', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->string('adres');
            $table->string('gemeente');
            $table->string('postcode');
            $table->dateTime('startdate');
            $table->string('event_afbeelding');
            $table->string('url');
        });
    }

    public function down()
    {
        Schema::dropIfExists('calendars');
    }

}
