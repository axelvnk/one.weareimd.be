@extends('layouts.frontend')


@section('title')
One.WeAreIMD.be
@stop

@section('header')
<header>
    <div id="intro">
        <h1>Dit is het officiële portaal voor en door IMD studenten.</h1>
        @if(!Auth::check())
        <a href="/register">Hier inschrijven</a>
        @endif
    </div>
    <div id="recap">
        <ul class="row">
            <li class="small-3 columns" data-item="first">
                <img src="img/assets/profile.png">
            </li>
            <li class="small-3 columns" data-item="second">
                <img src="img/assets/trophy.png">
            </li>
            <li class="small-3 columns" data-item="third">
                <img src="img/assets/magnifyingglass.png">
            </li>
            <li class="small-3 columns" data-item="fourth">
                <img src="img/assets/location.png">
            </li>
        </ul>
    </div>
    <ul class="row hide-for-small-only">
        <li class="small-3 columns first">
            <div class="arrow-down"></div>
            <p class="titel info">
                <a href="/register">Meld je aan</a>
            </p>
        </li>
        <li class="small-3 columns second">
            <div class="arrow-down"></div>
            <p class="titel info">
                <a href="/projects">Onderscheid jezelf</a>
            </p>
        </li>
        <li class="small-3 columns third">
            <div class="arrow-down"></div>
            <p class="titel info">
                <a href="/jobs">Vind een job</a>
            </p>
        </li>
        <li class="small-3 columns fourth">
            <div class="arrow-down"></div>
            <p class="titel info">
                <a href="/events">Plan een evenement in</a>
            </p>
        </li>
    </ul>
    <div id="info" class="row show-for-small-only">
        <div class="arrow-down"></div>
        <p class="titel">Meld je aan</p>
    </div>
</header>
@stop

@section('content')
<div id="index-projects">
    <div class="row">
        <h3 class="medium-12 columns">Nieuwste projecten</h3>
        <ul>
            @foreach($projects as $project)
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
                    <?php $test = false; ?>
                    @foreach($project->votes as $vote)
                    @if($vote->user_id == Auth::id())
                    <?php $test = true; ?>
                    @endif
                    @endforeach
                    @if($test)
                    <a class="unvoteProject" data-project="{{ $project->id }}"
                       href="projects/unvote/{{ $project->id }}">
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

                <p class="eigenaar">
                    Door <a href="profile/{{ $project->user_id }}">{{ $project->user->firstname }} {{
                        $project->user->name }}</a>
                    van {{ $project->user->class }}
                </p>
            </li>
            @endforeach
        </ul>
    </div>
</div>

<div class="row" id="most-recent">
    <div class="medium-12 columns">
        <div class="medium-4 columns">
            <span class="nieuw">Nieuw</span>

            <h3>Evenementen</h3>
            <ul>
                @foreach($events as $event)
                <li><p>
                        {{ date('j-m-o', strtotime($event->startdate)); }}
                        <a href="/events/{{ $event->id }}">{{ $event->name }}</a>
                        @
                        {{ $event->gemeente }}
                    </p>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="medium-4 columns">
            <span class="nieuw">Nieuw</span>

            <h3>Jobs</h3>
            <ul>
                @foreach($jobs as $job)
                <li>
                    <a href="/jobs/{{$job->id}}">
                        <div class="avatar-small">
                            <img src="{{ $job->logo }}">
                        </div>
                        <div class="avatar-small-info">
                            <p class="titel">{{ $job->functie }}</p>

                            <p>{{$job->werkgever}}</p>
                        </div>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="medium-4 columns">
            <span class="nieuw">Nieuw</span>

            <h3>Gebruikers</h3>
            <ul>
                @foreach($users as $user)
                <li>
                    <a href="profile/{{ $user->id }}">
                        <div class="avatar-small">
                            <img src="{{ $user->avatar }}">
                        </div>
                        <div class="avatar-small-info">
                            <p class="titel">{{ $user->firstname }} {{ $user->name }}</p>

                            <p>{{ $user->class }}</p>
                        </div>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

@stop
