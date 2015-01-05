@extends('layouts.frontend')

@section('title')
{{ $user->firstname }} {{ $user->name }}
@stop

@section('content')
<div class="row">
	<ul>
	@foreach ($user->projects as $project)
		<li>
			<p>{{{ $project->name }}}</p>
			<img src="{{{ $project->image }}}" width="200" height="200"><br>
			<a href="projecten/{{ $project->id }}/edit">Edit</a> | <a href="delete/{{ $project->image }}">delete</a>
		</li>
	@endforeach
	</ul>
</div>
@stop
