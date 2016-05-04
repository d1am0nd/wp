@extends('master')

@section('meta')
<title>Wizard-Poker | Hearthstone Card Collection</title>
<meta name="description" content="Wizard-Poker Cards - Hearthstone collectable cards with quick and responsive search">
<meta property="og:title" content="Wizard-Poker Cards - Hearthstone collectable cards with quick and responsive search" />
<meta name="twitter:title" content="Wizard-Poker Hearthstone Cards" />
<meta name="twitter:description" content="A quick responsive card search for collectable Hearthstone cards" />
@stop

@section('head')
@stop

@section('content')
<div class="container content-md" ng-app="cardsApp" ng-controller="SimpleController">
    <main ui-view autoscroll="false"></main>
</div>
@stop

@section('foot')
<script>
cardsUrl = "{{ action('CardsController@getCardsJson') }}";
attributesUrl = "{{ action('CardsController@getCardAttributesJson') }}";
</script>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-router/0.2.18/angular-ui-router.min.js"></script>
{!! Html::script('customJs/angular/cards.js') !!}