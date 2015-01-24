<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    {{ HTML::style('css/normalize.css') }}
    {{ HTML::style('css/foundation.css') }}
    {{ HTML::style('css/style.css') }}
</head>
<body>
@yield('content')
</body>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="/js/app.js"></script>
</html>
