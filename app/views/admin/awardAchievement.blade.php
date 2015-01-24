@extends('layouts.backend')

@section('title')
Achievements list
@stop

@section('content')
<div class="row">
    <h1>Award an achievement</h1>
</div>

<div class="row">
    <form method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Create an achievement</legend>
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
                <div class="large-2 columns">
                    <label>User
                        {{ Form::select('user', $users , Input::old('user')) }}
                    </label>
                </div>
                <div class="large-10 columns">
                    <label class="@if ($errors->has('experience')) error @endif">Experience
                        <input type="text" name="experience" value="{{ Input::old('werkgever') }}"
                               placeholder="Experience">
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
