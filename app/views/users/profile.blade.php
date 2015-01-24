@extends('layouts.frontend')

@section('title')
Profiel | {{ $user->firstname }} {{ $user->name }}
@stop

@section('content')
<div class="medium-12 columns">
    <div class="row">
        <div class="medium-8 columns">
            @if(!$user->type)
            <h2><span class="level"><span class="lv">lvl.</span>{{$xp['level']}}</span> {{ $user->firstname }} {{
                $user->name }}</h2>

            <div class="xpbartop"><span class="xpbar"><span style="width: {{($xp['leftOverXP']/$xp['required'])*100}}%;"
                                                            class="actualxp"></span><span class="xp">{{$xp['leftOverXP']}} / {{$xp['required']}} experience</span></span>
            </div>
            @else
            <h2>{{ $user->firstname }} {{ $user->name }}</h2>
            @endif
            <p><span class="titel">Geboortedatum:</span> {{ date('j-m-o', strtotime($user->dateofbirth)); }}</p>

            <p><span class="titel">Email:</span> {{ $user->email }}</p>
            @if(!empty($user->website))
            <p>
                <span class="titel">Website:</span>
                <a href="{{ $user->website }}" target="_blank">{{ $user->website }}</a>
            </p>
            @endif
            @if(!empty($user->about))
            <p class="titel">Over mezelf:</p>

            <p>{{ $user->about }}</p>
            @endif
            <div class="row">
                <div class="large-10 small-10 columns">
                    <br>
                </div>
                <div class="large-2 small-2 columns">

                </div>
            </div>

        </div>
        <div class="medium-4 columns">
            <div class="canvas-large">
                <img src="{{ $user->avatar }}">
            </div>
            <div class="awardInfo">
                <p class="titel"></p>

                <p class="description"></p>
            </div>

        </div>
    </div>
    @if(count($user->projects) > 0)
    <hr>
    <div class="row">
        <h3 class="medium-12 columns">Projecten</h3>
        <ul>
            @foreach($user->projects as $project)
            <li class="medium-4 columns project">
                <a href="/projects/{{ $project->id }}">
                    <div class="canvas-medium">
                        <img src="{{ $project->image }}">
                    </div>
                </a>

                <div class="comments">
                    <img class="icon" src="/img/svgs/fi-comment.svg">
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
                        <img class="icon" src="/img/svgs/fi-heart-red.svg">
                    </a>
                    @else
                    <a class="voteProject" data-project="{{ $project->id }}" href="projects/vote/{{ $project->id }}">
                        <img class="icon" src="/img/svgs/fi-heart.svg">
                    </a>
                    @endif
                    @else
                    <img class="icon" src="/img/svgs/fi-heart.svg">
                    @endif
                    <span class="totalVotes">{{ $project->votes->count() }}</span>
                </div>
                <p class="titel">{{ $project->name }}</p>

                <p class="eigenaar">
                    Door <a href="/profile/{{ $project->user_id }}">{{ $project->user->firstname }} {{
                        $project->user->name }}</a>
                    van {{ $project->user->class }}
                </p>
            </li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
@stop
