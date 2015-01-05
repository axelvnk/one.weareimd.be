@extends('layouts.frontend')


@section('title')
Jobs | One We Are IMD
@stop

@section('content')
	<div class="large-12 small-12 column">

	<h2>Jobs</h2>

	<div class="joblist">
		@foreach($jobs as $job)
			<a href="/{{Request::path();}}/{{$job->id}}">
				<div class="row job white">
					<div class="large-12 small-12 column">

						<strong>{{{$job->functie}}} - {{{$job->werkgever}}}</strong><br>
						<div class="large-6 column ">
						<img src="{{$job->logo}}" alt="{{$job->werkgever}}" width="100px" height="100px">
						</div>

						<div class="large-6 column ">
							{{$job->gemeente}}
						</br>
						</div>



					</div>
				</div>
			</a>
		@endforeach
	</div>
		<div class="row">
			<div class="large-12 small-12 column">
				<center><div id="load"></div></center>
			</div>
		</div>

	</div>
@stop
