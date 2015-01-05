<head>
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
@extends('layouts.frontend')


@section('title')
Events list
@stop


@section('content')

</head>
<body>
<div class="large-12 small-12 column ">



    <?php
      $vandaag = DB::select('select * from calendars where startdate = CURDATE()');
    ?>

    <div id="vandaag_wrapper">
    @if(count($vandaag) > 0)
         <h2>Vandaag op de planning</h2>

     @foreach ($vandaag as $b)


                <div id="events_vandaag" class="large-12 small-12 column ">

                  <div class="large-6 column ">
                    <img src="{{$b->event_afbeelding}}" alt="{{$b->name}}" width="150" height="150px">
                   </div>

                  <div class="large-6 column ">
                      <h3>{{ $b->name }}</h3>
                      <p>Datum: {{ date("d-m-Y", strtotime($b->startdate))  }}</br>
                      Locatie: {{$b->adres}} {{$b->gemeente}}</p>
                      <?php $deelnemers = DB::table('eventplanning')->where('event_id',$b->id);
                        $d= $deelnemers->count();
                      ?>

                      @if(  $d  ==  0)
                        Nog niemand gaat naar dit evenement
                      @elseif(  $d  ==  1)
                        Enkel jij gaat naar dit evenement, tijd om mensen uit te nodigen!
                      @else
                          <b>{{$d}}</b> Personen nemen deel aan dit evenement
                      @endif

                      <p><?php echo "<a href='/events/" . $b->id . "'>details</a>" ?></p>
                    </div>


                  </div>




       @endforeach

     @endif
    </div>



<h2>Geplande evenementen</h2>
   @foreach ($events as $c)
   @if( strtotime($c->startdate) > strtotime('now') )
      <div class="event_list column white">

        <div class="large-6 column ">
              <img src="{{$c->event_afbeelding}}" alt="{{$c->name}}" width="150" height="150px">
             </div>

            <div class="large-6 column ">
                <h3>{{ $c->name }}</h3>
                <p>Datum: {{ date("d-m-Y", strtotime($c->startdate))  }}</br>
                Locatie: {{$c->adres}} {{$c->gemeente}}</p>
                <?php $deelnemers = DB::table('eventplanning')->where('event_id',$c->id);
                  $d= $deelnemers->count();
                ?>


                   @if(  $d  ==  0)
                  Nog niemand gaat naar dit evenement
                @elseif(  $d  ==  1)
                  Enkel jij gaat naar dit evenement, tijd om mensen uit te nodigen!
                @else
                    <b>{{$d}}</b> Personen nemen deel aan dit evenement
                @endif
                <p><?php echo "<a href='/events/" . $c->id . "'>details</a>" ?></p>

              </div>


      </div>
      </tr>
      @endif
   @endforeach

</div>
</body>
</html>








@stop
