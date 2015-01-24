@extends('layouts.frontend')


@section('title')
Edit user - {{ $user->firstname }} {{ $user->name}}
@stop


@section('content')
<div class="row">
    <h1>Edit User</h1>
</div>

<div class="row">
    <form method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Edit this account</legend>
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
                    <label class="@if ($errors->has('email')) error @endif">E-mail
                        <input type="text" value="{{ $user->email }}" name="email" placeholder="E-mail">
                    </label>
                    <label class="@if ($errors->has('admin')) error @endif">Admin
                        <input type="checkbox" id="admin" name="admin" value="admin" @if($user->admin==1) checked
                        @endif>
                    </label>
                    <label class="@if ($errors->has('employee')) error @endif">Employee
                        <input type="checkbox" id="employee" name="employee" value="employee" @if($user->type==1)
                        checked @endif>
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="large-6 columns">
                    <label class="@if ($errors->has('firstname')) error @endif">First name
                        <input type="text" value="{{ $user->firstname }}" name="firstname" placeholder="John">
                    </label>
                </div>
                <div class="large-6 columns">
                    <label class="@if ($errors->has('name')) error @endif">Last name
                        <input type="text" value="{{ $user->name }}" name="name" placeholder="Doe">
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <label class="@if ($errors->has('class')) error @endif">Klasgroep
                        <input type="text" value="{{ $user->class }}" name="class" placeholder="1IMDA">
                    </label>
                    <label class="@if ($errors->has('dateofbirth')) error @endif">Date of birth
                        <input type="date" value="{{ $user->dateofbirth }}" name="dateofbirth">
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <label class="@if ($errors->has('avatar')) error @endif">Profielfoto
                        <div class="choose_file">
                            <span class="button medium large-3 columns" style="margin:0;">Bestand kiezen</span>
                            <span class="medium-9 columns fileName">Geen bestand gekozen</span>
                            <input class="file" name="avatar" type="file" style="height:0px;overflow:hidden;"/>
                        </div>
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <label class="@if ($errors->has('password')) error @endif">Password
                        <input type="password" name="password">
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <label class="@if ($errors->has('password_confirm')) error @endif">Confirm password
                        <input type="password" name="password_confirm">
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
                    <center><a href="/admin/user">Cancel</a></center>
                </div>
            </div>
        </fieldset>
    </form>
</div>
@stop
