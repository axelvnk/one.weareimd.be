@extends('layouts.frontend')

@section('title')
Edit Project | {{ $project->name }}
@stop


@section('content')
<div class="madium-12 columns">
	<h2>Bewerk je project</h2>
</div>
<form method="post" enctype="multipart/form-data">
	<div class="medium-12 columns">
        @if ($errors->has())
            <div data-alert class='alert-box alert radius'>
            @foreach ($errors->all() as $error)
                {{ $error }} <br>
            @endforeach
            </div>
        @endif
		<label>Titel
			<input type="text" name="name" value="{{ $project->name }}">
		</label>
		<label>Categorie
			<select name="category">
				<option value="{{ $project->category }}" selected>{{ $project->category }}</option>
				<option value="fotografie">Fotografie</option>
				<option value="logo">Logo design</option>
				<option value="illustratie">Illustratie</option>
				<option value="tekenen">Tekenen</option>
				<option value="webdesign">Webdesign</option>
				<option value="webdevelopment">Webdevelopment</option>
			</select>
		</label>
		<label>Beschrijving
			<textarea name="description">{{ $project->description }}</textarea>
		</label>
		<label>Afbeelding
	        <div class="choose_file">
	            <span class="button medium large-3 columns" style="margin:0;">Bestand kiezen</span>
	            <span class="medium-9 columns fileName">{{ $project->image }}</span>
	            <input class="file" name="avatar" type="file" style="height:0px;overflow:hidden;" />
	        </div>
	    </label>
		<input type="submit" class="button expand" value="Project bewerken">
	</div>
</form>
@stop
