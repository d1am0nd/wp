@extends('master')

@section('meta')
<title>Wizard-Poker | Hearthstone Pages</title>
<meta property="og:title" content="Wizard-Poker Hearthstone related pages" />
<meta name="twitter:title" content="Community posted hearthstone related pages" />
<meta name="twitter:description" content="If one boom bot is good, two are better. Pages with hearthstone advice and stuff" />
@stop

@section('head')
@stop

@section('content')
<div class="container content-md">
    <div class="row">
        <div class="col-md-4">
            @foreach(array_chunk($rarities->all(), 3) as $row)
            <div class="row">
                @foreach($row as $rarity)
                <div class="col-md-4">
                    <div class="margin-bottom-15">
                        <a href="{{ action('CardsController@index', ['rarity' => $rarity->name]) }}" class="btn btn-u">{{ $rarity->name }}</a>
                    </div>
                </div>
                @endforeach
            </div>
            @endforeach
        </div>
        <div class="col-md-8">
            <div class="row">
                @foreach($cards as $card)
                <div class="col-md-3">
                    <img class="img-responsive" src="{{ $card }}">
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@stop

@section('foot')
@stop