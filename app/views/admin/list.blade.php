@extends('layouts.backend')


@section('title')
User list
@stop


@section('content')

<h2>{{$title}}</h2>

<dl class="sub-nav">
    <dd class="active"><a href="/{{Request::path();}}/add">Create</a></dd>
</dl>

<table>
    <thead>
    <tr>
        @foreach ($headers as $key => $head)
        <th width="{{$head}}">{{$key}}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach ($data['data'] as $d)
    <tr>
        @foreach ($data['keys'] as $item)

        <td>{{$d[$item]}}</td>
        @endforeach
        <td><a href="/{{Request::path();}}/edit/{{ $d->id }}">Edit</a> - <a
                href="/{{Request::path();}}/delete/{{ $d->id }}">Delete</a></td>
    </tr>
    @endforeach
    </tbody>
</table>
@stop
