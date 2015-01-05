@extends('layouts.backend')


@section('title')
Edit Event - {{ $e->name }}
@stop


@section('content')
    <div class="row">
        <h1>Edit Event</h1>
    </div>

    <div class="row">
        <form method="post" enctype="multipart/form-data">
           <fieldset>
                <legend>Wijzig dit evenement</legend>
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
                        <label class="@if ($errors->has('naam')) error @endif">Event naam
                            <input type="text" value="{{ $e->name }}" name="naam" placeholder="Naam Event">
                        </label>
                    </div>
                </div>
                  <div class="row">
                    <div class="large-12 columns">
                        <label class="@if ($errors->has('omschrijving')) error @endif">Event omschrijving
                            <textarea name="omschrijving" placeholder="Event omschrijving">{{$e->description}} </textarea>
                        </label>
                    </div>
                </div>
              <div class="row">
                    <div class="large-12 columns">
                        <label class="@if ($errors->has('adres')) error @endif">Adres
                            <input type="text" value="{{ $e->adres }}" name="adres" placeholder="Event adres">
                        </label>
                        <label class="@if ($errors->has('gemeente')) error @endif">Gemeente
                            <input type="text" value="{{ $e->gemeente }}" name="gemeente" placeholder="Gemeente">
                        </label>
                        <label class="@if ($errors->has('postcode')) error @endif">Postcode
                            <input type="text" value="{{ $e->postcode }}" name="postcode" placeholder="Postcode">
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="large-12 columns">
                        <label class="@if ($errors->has('startdate')) error @endif">Datum
                            <input type="date" value="{{ date("Y-m-d",strtotime($e->startdate)) }}"


                             name="startdate" placeholder="Datum">
                        </label>
                    </div>
               </div>
                <div class="row">
                    <div class="large-12 columns">
                        <label class="@if ($errors->has('url')) error @endif">Url
                            <input type="text" value="{{ $e->url }}" name="url" placeholder="link met http://">
                        </label>
                    </div>
               </div>
               <div class="row">
                  <div class="large-12 large-centered columns">
                       <input type="submit" class="button expand">
                   </div>
               </div>
                <div class="row">
                  <div class="large-12 large-centered columns">
                       <center><a href="/admin/event">Cancel</a></center>
                   </div>
               </div>
            </fieldset>
        </form>
    </div>
@stop
