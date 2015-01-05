@extends('layouts.frontend')


@section('title')
Studenten
@stop

@section('content')
<h2 class="medium-9 columns">Al onze IMD'ers vind je hier</h2>
<form method="post" class="medium-3 columns">
	<label>
	<input type="text" id="search" name="search" placeholder="Student zoeken">
	</label>
</form>
<ul id="students">
	@foreach($users as $user)
	<li class="medium-3 columns student"><a href="/profile/{{ $user->id }}">
		<div class="canvas-medium">
			<img src="{{ $user->avatar }}">
		</div>
		<span class="username">{{ $user->firstname }} {{ $user->name }}</span>
	</a></li>
	@endforeach
</ul>
@stop
