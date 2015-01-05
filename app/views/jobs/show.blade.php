@extends('layouts.frontend')


@section('title')
{{{$job->functie}}} {{{$job->werkgever}}}
@stop

@section('content')
<div class="large-12 small-12 column white job_detail">

	<h2>{{{$job->functie}}} {{{$job->werkgever}}}</h2>
	<div class="large-6 column white">
		<img src="{{$job->logo}}" alt="{{$job->werkgever}}" width="100px" height="100px">
		</br>
		<strong>Contactgegevens</strong>
		<p>Adres: {{ $job->adres }} <br>{{$job->postcode}} {{$job->gemeente}}<br>
		@if($job->telefoon )Telefoon: {{ $job->telefoon }}<br>@endif
		Email: {{ $job->email }}</p>
	</div>

	<div class="large-6 column white">
	<p>{{ $job->beschrijving }}</p>


	</div>
</div>

@stop
