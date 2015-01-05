@extends('layouts.frontend')

@section('title')
Not found
@stop

@section('content')
<h1>{{$type}} : {{$param}} not found.</h1>
<p>The {{$type}} {{$param}} was not found</p>
@stop
