@extends('layouts.teaser')


@section('title')
Teaser page
@stop

<?php
$clientid = "41c2ef7dd1944014af611a29e9092f20";
$url = "https://api.instagram.com/v1/tags/weareimd/media/recent?client_id=" . $clientid;

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);

$results = json_decode(curl_exec($curl));
?>

@section('content')
<div class="teaser">
    <?php
    $t = 1;
    echo "<ul id='images'>";
    foreach ($results->data as $result) {
        if ($t % 5 == 0) {
            echo "<li><img src='" . $result->images->thumbnail->url . "'></li><br>";
        } else {
            echo "<li><img src='" . $result->images->thumbnail->url . "'></li>";
        }
        $t = $t + 1;
    }
    echo "</ul>";
    ?>
    <div id="wrapper">
        <div class="row">
            <div class="large-8 columns">
                <h1>One IMD app</h1>

                <h3>The site is currently under construction and will be online near the end of 2014. We will bring an
                    online platform for all you IMD'ers out there. Sign up and be notified when we launch!</h3>
            </div>
        </div>

        <div class="row">
            <form method="post">
                <div class="large-8 columns">
                    <div class="row collapse">
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
                        <div class="small-10 columns">
                            <input type="text" name="email" value="{{ Input::old('email') }}"
                                   placeholder="YourEmail@example.com">
                        </div>
                        <div class="small-2 columns">
                            <input class="button postfix" type="submit" value="Sign up!">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
