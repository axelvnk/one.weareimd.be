@extends('layouts.backend')

@section('title')
Achievements list
@stop

@section('content')
<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Naam</th>
        <th>Beschrijving</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($achievements as $achievement)
    <tr>
        <td>{{ $achievement->id }}</td>
        <td>{{ $achievement->name }}</td>
        <td>{{ $achievement->description }}</td>
    </tr>
    @endforeach
    </tbody>
</table>
@stop
