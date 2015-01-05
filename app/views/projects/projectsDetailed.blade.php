@extends('layouts.frontend')


@section('title')
{{ $project->user->firstname }} {{ $project->user->name }} | {{ $project->name }}
@stop


@section('content')
<div class="row">
<div class="medium-6 columns">
	<img src="{{ $project->image }}">
</div>
<div class="medium-6 columns project-details">
	<p class="nieuw">{{ $project->category }}</p>
	<h2>{{ $project->name }}</h2>
	<p class="eigenaar">Gemaakt door
		<a href="/profile/{{$project->user->id}}">{{$project->user->firstname}} {{$project->user->name}}</a>
		 op {{ date('j-m-o', strtotime($project->created_at)); }}
	</p>
	<p>{{ $project->description }}</p>
	<p>
		@if(Auth::id() == $project->user->id)
		<a href="edit/{{ $project->id }}">Edit</a> |
		<a href="delete/{{ $project->id }}">Delete</a>
		@endif
	</p>
</div>
</div>
<div class="row">
	<div class="medium-12 columns">
	<div class="postComment">
		@if(Session::get('feedback'))
			<div data-alert class='alert-box alert radius'>
				{{Session::get('feedback')['error']}}
			</div>
		@endif
		@if ($errors->has())
			<div data-alert class='alert-box alert radius'>
		       	@foreach ($errors->all() as $error)
		           	{{ $error }}
		        @endforeach
		    </div>
		@endif
		@if(Session::has('message'))
		    <div data-alert class="alert-box success radius">
		    	{{Session::get('message')}}
		    </div>
		@endif
		@if(Auth::check())
		<form method="post">
			<textarea name="text"></textarea>
			<input value="Verzenden" type="submit" data-project="{{$project->id}}" class="button commentButton">
		</form>
		@else
			<div data-alert class="alert-box radius"><a href="/login">Log in</a> om te reageren op dit project.</div>
		@endif
		</div>
		<h3 id="comments-titel">{{ $project->comments->count() }} Commentaren</h3>
		<ul class="comments">
			@foreach($project->comments as $comment)
			<li data-comment="{{$comment->id}}">
				<a href="/profile/{{ $comment->user->id }}" class="avatar-small">
					<img src="{{ $comment->user->avatar }}">
				</a>
				<div class="avatar-small-info">
					<a href="/profile/{{ $comment->user->id }}">
						<p class="titel">{{ $comment->user->firstname }} {{ $comment->user->name }}</p>
					</a>
					<p>{{ $comment->text }}</p>
				</div>
				@if(Auth::id() == $comment->user->id)
				<a href="/comments/delete/{{$comment->id}}" class="commentdel"><div class="commentactions"></div></a>
				@endif
			</li>
			@endforeach
		</ul>
	</div>
</div>
@stop
