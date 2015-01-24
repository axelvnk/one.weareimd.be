@extends('layouts.frontend')


@section('title')
Profiel bewerken
@stop


@section('content')
<div class="large-12 columns">
    <h2>Bewerk je profiel</h2>
</div>

<form method="post" enctype="multipart/form-data">
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

        <label class="@if ($errors->has('email')) error @endif">Email
            <input type="text" value="{{ $user->email }}" name="email">
        </label>
    </div>

    <div class="large-6 columns">
        <label class="@if ($errors->has('firstname')) error @endif">Voornaam
            <input type="text" value="{{ $user->firstname }}" name="firstname">
        </label>
    </div>
    <div class="large-6 columns">
        <label class="@if ($errors->has('name')) error @endif">Naam
            <input type="text" value="{{ $user->name }}" name="name">
        </label>
    </div>

    <div class="large-12 columns">
        @if($user->class)
        <label class="@if ($errors->has('class')) error @endif">Klasgroep
            <input type="text" value="{{ $user->class }}" name="class">
        </label>
        @endif

        <label class="@if ($errors->has('dateofbirth')) error @endif">Geboortedatum
            <input type="date" value="{{ $user->dateofbirth }}" name="dateofbirth">
        </label>

        <label class="@if ($errors->has('website')) error @endif">Website
            <input type="text" value="{{ $user->website }}" name="website" placeholder="http://example.com">
        </label>

        <label class="@if ($errors->has('about')) error @endif">Over mezelf
            <textarea name="about">{{ $user->about }}</textarea>
        </label>

        <label class="@if ($errors->has('avatar')) error @endif">Profielfoto
            <div class="choose_file">
                <span class="button medium large-3 columns" style="margin:0;">Bestand kiezen</span>
                <span class="medium-9 columns fileName">Geen bestand gekozen</span>
                <input class="file" name="avatar" type="file" style="height:0px;overflow:hidden;"/>
            </div>
        </label>

        <label class="@if ($errors->has('password')) error @endif">Nieuw paswoord
            <input type="password" name="password">
        </label>

        <label class="@if ($errors->has('password_confirm')) error @endif">Bevestig paswoord
            <input type="password" name="password_confirm">
        </label>

        <input value="Verzenden" type="submit" class="button expand">
        <center><a href="/profile">Annuleer</a></center>
    </div>
</form>
@stop
