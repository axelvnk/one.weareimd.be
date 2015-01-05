@extends('layouts.frontend')


@section('title')
{{{$event->name}}} {{{$event->name}}}
@stop

@section('content')
<div class="large-12 small-12 column white event_detail" >
  <h2>{{{$event->name}}} </h2>


<div class="large-6 column white">
  <h2><img src="{{$event->event_afbeelding}}" alt="{{$event->name}}" width="300px" height="300px"></h2>
  <p>{{{$event->place}}}</p>
  <p>Datum: {{ date("d-m-Y", strtotime($event->startdate))  }}</p>
  <h3>Locatie</h3>
  <p>{{ $event->adres }}
  </br>{{ $event->gemeente }}, {{ $event->postcode }}</p>
  <p><a href={{ $event->url }}>{{ $event->url }} </a></p>
</div>

<div class="large-6 column white">
 <p> <strong>Omschrijving: </strong></br> {{{$event->description}}}
</div>

<div class="large-12 column white">
 </br>

@if (Auth::check())
<form method="post" enctype="multipart/form-data">
           <fieldset style="border=none;">
                <div class="row">
                  <div class="large-12 large-centered columns">

                   <?php

                    $user_planning = DB::table('eventplanning')
                    ->where('user_id', '=', Auth::id())
                    ->where('event_id', '=', $event->id)
                    ->first();

                if (is_null($user_planning)) {
                    echo "<input type='submit' class='button' value='DEELNEMEN'>";
                } else {
                    echo "<h3>Event staat op jouw planning</h3>";
                }


                       ?>


                   </div>
               </div>


               </div>


            </fieldset>
        </form>
@endif


</div>


</div>

@stop
