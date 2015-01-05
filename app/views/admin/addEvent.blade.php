@extends('layouts.backend')


@section('title')
Add Event
@stop


@section('content')
    <div class="row">
        <h1>Add Event</h1>
    </div>

    <div class="row">
        <form method="post" enctype="multipart/form-data">
           <fieldset>
                <legend>Place your Event</legend>
                <div class="row">
                   <div class="large-12 columns">
                        @if ($errors->has())
                            <div data-alert class='alert-box alert radius'>
                            @foreach ($errors->all() as $error)
                                {{ $error }} <br>
                            @endforeach
                            </div>
                        @endif
                        @if(Session::has('message'))
                        <div data-alert class="alert-box success radius">
                            {{Session::get('message')}}
                        </div>
                    @endif
                    </div>
                </div>
                <div class="row">
                    <div class="large-12 columns">
                        <label class="@if ($errors->has('naam')) error @endif">Event Naam
                            <input type="text" value="{{ Input::old('naam') }}" name="naam" placeholder="Naam Event">
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="large-12 columns">
                        <label class="@if ($errors->has('eventafb')) error @endif">Event afbeelding
                            <div class="choose_file">
                                <span class="button medium large-3 columns" style="margin:0;">Bestand kiezen</span>
                                <span class="medium-9 columns fileName">Geen bestand gekozen</span>
                                <input class="file" name="eventafb" type="file" style="height:0px;overflow:hidden;" />
                            </div>
                        </label>

                        <label class="@if ($errors->has('omschrijving')) error @endif">Event omschrijving
                            <textarea name="omschrijving" placeholder="Event omschrijving"></textarea>
                        </label>
                    </div>
                </div>
             <div class="row">
                    <div class="large-12 columns">
                        <label class="@if ($errors->has('adres')) error @endif">Adres
                            <input type="text" value="{{ Input::old('adres') }}" name="adres" placeholder="Adres">
                        </label>
                        <label class="@if ($errors->has('gemeente')) error @endif">Gemeente
                            <input type="text" value="{{ Input::old('gemeente') }}" name="gemeente" placeholder="Gemeente">
                        </label>
                        <label class="@if ($errors->has('postcode')) error @endif">Postcode
                            <input type="text" value="{{ Input::old('postcode') }}" name="postcode" placeholder="Postcode">
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="large-12 columns">
                        <label class="@if ($errors->has('startdate')) error @endif">Start Event
                            <input type="date" value="{{ Input::old('startdate') }}" name="startdate" placeholder="Start Event">
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="large-12 columns">
                        <label class="@if ($errors->has('url')) error @endif">Url
                            <input type="text" value="{{ Input::old('url') }}" name="url" placeholder="link met http://">
                        </label>
                    </div>
                </div>
                <div class="row">
                  <div class="large-12 large-centered columns">
                       <input type="submit" class="button expand">
                   </div>
               </div>


               </div>


            </fieldset>
        </form>
    </div>
@stop
