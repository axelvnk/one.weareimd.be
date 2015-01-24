@extends('layouts.frontend')


@section('title')
Edit Project - {{ $p->name }}
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
                    <label class="@if ($errors->has('name')) error @endif">Project name
                        <input type="text" value="{{ $p->name }}" name="name" placeholder="Name">
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="large-12 columns">
                    <label class="@if ($errors->has('description')) error @endif">Project description
                        <input type="text" value="{{ $p->description }}" name="description" placeholder="Description">
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
                    <center><a href="/admin/project">Cancel</a></center>
                </div>
            </div>
        </fieldset>
    </form>
</div>
@stop
