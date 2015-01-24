@extends('layouts.frontend')


@section('title')
User login
@stop


@section('content')
<div class="large-6 columns">
    <h2>Hier inloggen</h2>

    <form method="post">
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
        <label for="email" class="@if ($errors->has('email')) error @endif">Email</label>
        <input type="text" name="email" placeholder="Email">
        <label for="password" class="@if ($errors->has('password')) error @endif">Paswoord</label>
        <input type="password" name="password">
        <input type="submit" value="Log in" class="button">
        <a class="register" href="../register">Registreer</a>
    </form>
</div>
@stop
