@extends('layouts.frontend')

@section('title')
Project toevoegen
@stop

@section('content')
<div class="medium-12 columns">
	<h2>Hier kan u een project toevoegen</h2>
	@if(Session::get('feedback'))
		<div data-alert class='alert-box alert radius'>
			{{Session::get('feedback')['error']}}
		</div>
	@endif
	@if ($errors->has())
		<div data-alert class='alert-box alert radius'>
	       	@foreach ($errors->all() as $error)
	           	{{ $error }} <br>
	        @endforeach
	    </div>
	@endif
	@if(Session::has('message'))
	    <div data-alert class="alert-box success radius">
	    	{{Session::get('message')}}
	    </div>
	@endif
	<form method="post" enctype="multipart/form-data">
		<label class="@if ($errors->has('name')) error @endif">Titel</label>
		<input type="text" name="name" value="{{ Input::old('name') }}" placeholder="Schrijf hier een titel">
		<label class="@if ($errors->has('category')) error @endif">Categorie</label>
		<select name="category">
			<option value="" disabled @if(!Input::old('category')) selected @endif>Categorie</option>
			<option value="fotografie" @if(Input::old('category')=='fotografie') selected @endif>Fotografie</option>
			<option value="logo" @if(Input::old('category')=='logo') selected @endif>Logo design</option>
			<option value="illustratie" @if(Input::old('category')=='illustratie') selected @endif>Illustratie</option>
			<option value="tekenen" @if(Input::old('category')=='tekenen') selected @endif>Tekenen</option>
			<option value="webdesign" @if(Input::old('category')=='webdesign') selected @endif>Webdesign</option>
			<option value="webdevelopment" @if(Input::old('category')=='webdevelopment') selected @endif>Webdevelopment</option>
		</select>
		<label class="@if ($errors->has('description')) error @endif">Beschrijving</label>
		<textarea name="description" placeholder="en een beschrijving">{{ Input::old('description') }}</textarea>
		<label class="@if ($errors->has('image')) error @endif">Afbeelding
			<div class="choose_file">
		        <span class="button medium-3 columns" style="margin:0;">Bestand kiezen</span>
		        <span class="medium-9 columns fileName">Geen bestand gekozen</span>
		        <input type="file" name="image" class="file" style="height:0px;overflow:hidden;">
		    </div>
        </label>
		<input type="submit" class="button expand" value="Project toevoegen">
	</form>
</div>
@stop
