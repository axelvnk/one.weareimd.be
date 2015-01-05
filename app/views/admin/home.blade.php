@extends('layouts.backend')


@section('title')
Admin dashboard
@stop



@section('content')
<div class="row">
<div class="large-12 columns">
   <h2>Admin dashboard</h2>
        <ul>
            <li><a href="/admin/user">Userlist</a></li>
            <li><a href="/admin/project">Projectlist</a></li>
            <li><a href="/admin/award">Awardlist</a></li>
            <li><a href="/admin/event">Eventlist</a></li>
            <li><a href="/admin/job">Joblist</a></li>
        </ul>
    </div>
</div>
@stop
