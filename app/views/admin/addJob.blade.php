@extends('layouts.backend')


@section('title')
Add Job
@stop


@section('content')
<div class="row">
    <h1>Add Job</h1>
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
                        <input type="text" value="{{ Input::old('functie') }}" name="functie" placeholder="Job functie">
                    </label>
                    <label class="@if ($errors->has('description')) error @endif">Beschrijving
                        <textarea name="description" placeholder="en een beschrijving"></textarea>
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <label class="@if ($errors->has('werkgever')) error @endif">Werkgever
                        <input type="text" value="{{ Input::old('werkgever') }}" name="werkgever"
                               placeholder="Job werkgever">
                    </label>

                    <label class="@if ($errors->has('logo')) error @endif">Logo
                        <div class="choose_file">
                            <span class="button medium large-3 columns" style="margin:0;">Bestand kiezen</span>
                            <span class="medium-9 columns fileName">Geen bestand gekozen</span>
                            <input class="file" name="logo" type="file" style="height:0px;overflow:hidden;"/>
                        </div>
                    </label>
                </div>
            </div>

            <div class="row">
                <div class="large-12 columns">
                    <label class="@if ($errors->has('adres')) error @endif">Adres
                        <input type="text" value="{{ Input::old('adres') }}" name="adres" placeholder="Job locatie">
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
                    <label class="@if ($errors->has('email')) error @endif">Email
                        <input type="text" value="{{ Input::old('email') }}" name="email"
                               placeholder=" email werkgever">
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <label class="@if ($errors->has('telefoon')) error @endif">Telefoon
                        <input type="text" value="{{ Input::old('telefoon') }}" name="telefoon"
                               placeholder="telefoon werkgever">
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="large-12 large-centered columns">
                    <input type="submit" class="button expand">
                </div>
            </div>
        </fieldset>
    </form>
</div>
@stop
