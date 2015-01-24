@extends('layouts.frontend')


@section('title')
Something went wrong!
@stop


@section('content')
<div class="row">
    <div class="large-12 columns">
        <h2>Something went wrong</h2>
        @if ($error)
        <div data-alert class='alert-box alert radius'>
            {{ $error }} <br>
        </div>
        @endif
    </div>
</div>
@stop
