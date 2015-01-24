<!DOCTYPE html>
<html lang="nl">
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
            <li><a href="/admin">Dashboard</a></li>
            <li><a href="/admin/user">Users</a></li>
            <li><a href="/admin/project">Projects</a></li>
            <li><a href="/admin/job">Jobs</a></li>
            <li><a href="/admin/event">Events</a></li>
            <li><a href="/admin/award">Awards</a></li>
        </ul>
    </section>
</nav>

<div class="row">
    <div class="large-12 small-12 column white wrapper">
        @yield('content')
    </div>
</div>
</body>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="/js/foundation.js" type="text/javascript"></script>
<script src="/js/foundation.topbar.js" type="text/javascript"></script>
<script>$(document).foundation();</script>
</html>
