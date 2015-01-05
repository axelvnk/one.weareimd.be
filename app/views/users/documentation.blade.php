@extends('layouts.frontend')

@section('title')
Api documentation
@stop

@section('content')

<div class="row">
	<div class="api_documentation">
			<h3>ACHIEVEMENTS API</h3>
			<p>Een overzicht van alle gegeven achievements</p>
			<a href="api/v1/achievements">api/v1/achievements</a>
		</div>

	<div class="api_documentation">
			<h3>EVENEMENTEN API</h3>
			<p>Geeft alle geplande events weer</p>
			<a href="api/v1/events">api/v1/events</a>
		</div>

		<div class="api_documentation">
			<h3>GEBRUIKERS API</h3>
			<p>Krijg een overzicht van alle gebruikers </p>
			<a href="api/v1/users">api/v1/users</a>
		</div>

		<div class="api_documentation">
			<h3>JOBS API</h3>
			<p>Krijg een overzicht van alle geplaatste Jobs </p>
			<a href="api/v1/jobs">api/v1/jobs</a>
		</div>

		<div class="api_documentation">
			<h3>PROJECTE API</h3>
			<p>Geeft een overzicht van alle ingevoerde projecten</p>
			<a href="api/v1/projects">api/v1/projects</a>
		</div>

		<div class="api_documentation">
			<h3>TODO'S API</h3>
			<p>Geeft een overzicht van alle geplande taken</p>
			<a href="api/v1/projects">api/v1/todos</a>
		</div>
	</div>

@stop
