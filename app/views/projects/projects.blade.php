@extends('layouts.frontend')


@section('title')
Projecten
@stop

@section('content')
	<h2 class="medium-12 columns">Alle projecten van onze IMD'ers</h2>
	<form method="post" id="filter">
		<label class="medium-4 columns">Volgorde
			<select class="order" name="order">
				<option value="" selected disabled>Volgorde</option>
				<option value="desc">Nieuwste</option>
				<option value="asc">Oudste</option>
			</select>
		</label>
		<label class="medium-4 columns">Categorie
			<select class="category" name="category">
				<option value="" selected>Alles</option>
				<option value="fotografie">Fotografie</option>
				<option value="logo">Logo design</option>
				<option value="illustratie">Illustratie</option>
				<option value="tekenen">Tekenen</option>
				<option value="webdesign">Webdesign</option>
				<option value="webdevelopment">Webdevelopment</option>
			</select>
		</label>
	</form>
	<ul id="projects">
		@foreach ($projects as $project)
			<li class="medium-4 columns project">
				<a href="projects/{{ $project->id }}">
					<div class="canvas-medium">
						<img src="{{ $project->image }}">
					</div>
				</a>
				<div class="comments">
					<img class="icon" src="img/svgs/fi-comment.svg">
					{{ $project->comments->count() }}
				</div>
				<div class="voting">
					@if(Auth::check())
						<?php $test=false; ?>
					@foreach($project->votes as $vote)
						@if($vote->user_id == Auth::id())
							<?php $test = true; ?>
						@endif
					@endforeach
						@if($test)
							<a class="unvoteProject" data-project="{{ $project->id }}" href="projects/unvote/{{ $project->id }}">
								<img class="icon" src="img/svgs/fi-heart-red.svg">
							</a>
						@else
							<a class="voteProject" data-project="{{ $project->id }}" href="projects/vote/{{ $project->id }}">
								<img class="icon" src="img/svgs/fi-heart.svg">
							</a>
						@endif
					@else
						<img class="icon" src="/img/svgs/fi-heart.svg">
					@endif
					<span class="totalVotes">{{ $project->votes->count() }}</span>
				</div>
				<p class="titel">{{ $project->name }}</p>

				<!--
				<div class="voting">
					@if(Auth::check())
					<?php $test=false; ?>
					@foreach($project->votes as $vote)
						@if($vote->user_id == Auth::id())
							<?php $test = true; ?>
						@endif
					@endforeach
						@if($test)
							<a class="unvoteProject" data-project="{{ $project->id }}" href="projects/unvote/{{ $project->id }}">Gestemd</a>
						@else
							<a class="voteProject" data-project="{{ $project->id }}" href="projects/vote/{{ $project->id }}">Stemmen</a>
						@endif
					@endif
				</div>
				-->
				<p class="eigenaar">
					Door <a href="profile/{{ $project->user_id }}">{{ $project->user->firstname }} {{ $project->user->name }}</a>
					van {{ $project->user->class }}
				</p>
			</li>
		@endforeach
	</ul>
	<div id="load"></div>
@stop
