@extends('layouts.backend')


@section('title')
Add Job
@stop


@section('content')
    <div class="row">
        <h1>Edit Job</h1>
    </div>

    <div class="row">
        <form method="post" enctype="multipart/form-data">
           <fieldset>
                <legend>Place your job</legend>
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
                        <label class="@if ($errors->has('functie')) error @endif">Functie
                            <input type="text" value="{{ $job->functie }}" name="functie" placeholder="Job functie">
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="large-12 columns">
                        <label class="@if ($errors->has('werkgever')) error @endif">Werkgever
                            <input type="text" value="{{ $job->werkgever }}" name="werkgever" placeholder="Job werkgever">
                        </label>
                    </div>
                </div>

                <div class="row">
                    <div class="large-12 columns">
                        <label class="@if ($errors->has('adres')) error @endif">Adres
                            <input type="text" value="{{ $job->adres }}" name="adres" placeholder="Job locatie">
                        </label>
                    </div>
                </div>

                <div class="row">
                    <div class="large-12 columns">
                        <label class="@if ($errors->has('email')) error @endif">Email
                            <input type="text" value="{{ $job->email }}" name="email" placeholder=" email werkgever">
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="large-12 columns">
                        <label class="@if ($errors->has('telefoon')) error @endif">Telefoon
                            <input type="text" value="{{ $job->telefoon }}" name="telefoon" placeholder="telefoon werkgever">
                        </label>
                    </div>
                </div>
               <div class="row">
                  <div class="large-12 large-centered columns">
                       <input type="submit" class="button expand" value="Job bijwerken">
                   </div>
               </div>
            </fieldset>
        </form>
    </div>
@stop
