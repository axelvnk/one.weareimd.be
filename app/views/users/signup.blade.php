@extends('layouts.frontend')


@section('title')
Inschrijven
@stop


@section('content')
<div class="large-12 columns">
  <h2>Maak hier een profiel aan</h2>
</div>

<form id="signup" method="post" enctype="multipart/form-data">
   <div class="large-12 columns">
        @if ($errors->has())
            <div data-alert class='alert-box alert radius'>
            @foreach ($errors->all() as $error)
                {{ $error }} <br>
            @endforeach
            </div>
        @endif
        @if(Session::has('feedback'))
        <div data-alert class="alert-box success radius">
            {{Session::get('feedback')}}
        </div>
        @endif

		  <div class="row">
		  	<div class="large-12 columns"><label>Selecteer het type gebruiker:</label>
				<div class="large-6 columns button @if(Input::old('type')==1) notselected @endif radio">
				  <input type="radio" name="type" value="0" id="typeStudent" @if(Input::old('type')==0) checked @endif><label class="typeStudent" for="typeStudent">Student</label>
				</div>
				<div class="large-6 columns button @if(Input::old('type')==0) notselected @endif radio">
				  <input type="radio" name="type" value="1" id="typeWerkgever" @if(Input::old('type')==1) checked @endif><label class="typeWerkgever" for="typeWerkgever">Werkgever</label>
				</div>
			</div>
	   </div>

        <label class="@if ($errors->has('email')) error @endif">Email
            <input type="text" value="{{ Input::old('email') }}" name="email" placeholder="Email">
        </label>
    </div>

    <div class="large-6 columns">
        <label class="@if ($errors->has('firstname')) error @endif">Voornaam
            <input type="text" value="{{ Input::old('firstname') }}" name="firstname" placeholder="Jan">
        </label>
    </div>
    <div class="large-6 columns">
        <label class="@if ($errors->has('name')) error @endif">Achternaam
            <input type="text" value="{{ Input::old('name') }}" name="name" placeholder="Janssens">
        </label>
    </div>

    <div class="large-12 columns">
       <div class="classinput">
			<label class="@if ($errors->has('class')) error @endif">Klasgroep
				<input type="text" value="{{ Input::old('class') }}" name="class" placeholder="1IMDA">
			</label>
        </div>

        <label class="@if ($errors->has('dateofbirth')) error @endif">Geboortedatum
           <input type="date" value="{{ Input::old('dateofbirth') }}" name="dateofbirth">
        </label>

        <label class="@if ($errors->has('avatar')) error @endif">Profielfoto
            <div class="choose_file">
                <span class="button medium large-3 columns" style="margin:0;">Bestand kiezen</span>
                <span class="medium-9 columns fileName">Geen bestand gekozen</span>
                <input class="file" name="avatar" type="file" style="height:0px;overflow:hidden;" />
            </div>
        </label>

        <label class="@if ($errors->has('password')) error @endif">Paswoord
           <input type="password" name="password">
        </label>

        <label class="@if ($errors->has('password_confirm')) error @endif">Bevestig paswoord
           <input type="password" name="password_confirm">
        </label>

        <input type="submit" class="button expand" value="Registreer">
    </div>
</form>

@stop
