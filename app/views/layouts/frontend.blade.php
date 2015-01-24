<?php

if (Cache::has('cache_instagram')) {
    $results = Cache::get('cache_instagram');
} else {
    $clientid = "41c2ef7dd1944014af611a29e9092f20";
    $url = "https://api.instagram.com/v1/tags/weareimd/media/recent?client_id=" . $clientid;

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);

    $results = curl_exec($curl);

    Cache::put('cache_instagram', $results, 60); // 1 hour

}

$results = json_decode($results);

?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>@yield('title')</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    {{ HTML::style('css/normalize.css') }}
    {{ HTML::style('css/foundation.css') }}
    {{ HTML::style('css/style.css') }}
</head>
<body>
<nav class="top-bar" data-topbar role="navigation">
    <ul class="title-area">
        <li class="name">
            <a id="logo" href="/">One.WeAreIMD.be</a>
        </li>
        <li class="toggle-topbar menu-icon">
            <a href="#"><span>menu</span></a>
        </li>
    </ul>

    <section class="top-bar-section">
        <ul>
            <li><a href="/">Startpagina</a></li>
            <li><a href="/students">Studenten</a></li>
            <li><a href="/projects">Projecten</a></li>
            <li><a href="/jobs">Jobs</a></li>
            <li><a href="/events">Evenementen</a></li>
            @if (Auth::check())
            <li class="has-dropdown">
                <a href="" id="auth" data-auth='{{Auth::id()}}'>{{ Auth::user()->firstname }} {{ Auth::user()->name
                    }}</a>
                <ul class="dropdown">
                    <li><a href="/profile">Mijn profiel</a></li>
                    <li><a href="/profile/edit">Profiel bewerken</a></li>
                    <li><a href="/project/add">Project toevoegen</a></li>
                    @if (Auth::user()->admin)
                    <li><a href="/admin">Admin</a></li>
                    @endif
                    <li><a href="/logout">Log out</a></li>
                </ul>
            </li>
            @else
            <li id="login"><a href="/login">Log in</a></li>
            @endif
        </ul>
    </section>
</nav>

@yield('header')

<div class="row">
    <div class="wrapper">
        @yield('content')
    </div>
</div>

<footer>
    <?php
    echo "<ul id='footerFirst' class='inline-list hide-for-small'>";
    foreach ($results->data as $result) {
        if ($result->user->username != "imtoofabluv" && $result->user->username != "live_free_tally") {
            echo "<li><img src='" . $result->images->thumbnail->url . "'></li>";
        }
    }
    echo "</ul>";
    ?>
    <div id="footerSec" class="row">
        <ul class="small-6 columns">
            <li><a href="/students">Studenten</a></li>
            <li><a href="/projects">Projecten</a></li>
            <li><a href="/jobs">Jobs</a></li>
            <li><a href="/events">Evenementen</a></li>
            @if (Auth::check())
            <li><a href="/logout">Uitloggen</a></li>
            @else
            <li><a href="/login">Inloggen</a></li>
            @endif
        </ul>
        <div class="small-6 columns copy">
            <p>IMD 2014 &#169; Gemaakt door en voor studenten</p>
        </div>

    </div>
</footer>

</body>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="/js/foundation.js" type="text/javascript"></script>
<script src="/js/foundation.topbar.js" type="text/javascript"></script>
<script src="/js/app.js"></script>
<script>$(document).foundation();</script>
</html>
