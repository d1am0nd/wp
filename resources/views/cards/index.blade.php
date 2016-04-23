@extends('master')

@section('meta')
<title>Wizard-Poker | Hearthstone Card Collection</title>
<meta property="og:title" content="Wizard-Poker - Hearthstone Card Collection" />
<meta name="twitter:title" content="Wizard-Poker - Hearhtstone Card Collection" />
<meta name="twitter:description" content="A quick responsive card search for collectable Hearthstone cards" />
@stop

@section('head')
@stop

@section('content')
<div class="container content-md" ng-app="cardsApp" ng-controller="SimpleController">
    <br><br><br>
    <div class="row">
        <div class="col-md-4">
            <div class="row margin-bottom-10">
                <div class="col-md-12">
                    <h3>Search by name:</h3>
                    <input type="text" data-ng-model="search.name" /> @{{ search.name }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3>Rarities</h3>
                </div>
                <div class="col-sm-4 col-xs-4">
                    <div class="margin-bottom-15">
                        <button class="btn btn-u btn-u-dark" ng-click="search.rarity = ''">Clear</button>
                    </div>
                </div>
                <div class="col-sm-4 col-xs-4" data-ng-repeat="name in cardAttributes.rarities">
                    <div class="margin-bottom-15">
                        <button class="btn btn-u" ng-click="search.rarity = name">@{{ name }}</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3>Classes</h3>
                </div>
                <div class="col-sm-4 col-xs-4">
                    <div class="margin-bottom-15">
                        <button class="btn btn-u btn-u-dark" ng-click="search.class = ''">Clear</button>
                    </div>
                </div>
                <div class="col-sm-4 col-xs-4" data-ng-repeat="name in cardAttributes.classes">
                    <div class="margin-bottom-15">
                        <button class="btn btn-u" ng-click="search.class = name">@{{ name }}</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3>Sets</h3>
                </div>
                <div class="col-sm-4 col-xs-4">
                    <div class="margin-bottom-15">
                        <button class="btn btn-u btn-u-dark" ng-click="search.set = ''">Clear</button>
                    </div>
                </div>
                <div class="col-sm-4 col-xs-4" data-ng-repeat="name in cardAttributes.sets">
                    <div class="margin-bottom-15">
                        <button class="btn btn-u" ng-click="search.set = name">@{{ name }}</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-sm-3 col-xs-6" data-ng-repeat="card in cards | filter:search | limitTo:28 | orderBy:'name'">
                    <img class="img-responsive" src="@{{ card.image_path }}">
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('foot')
<script>
cardsUrl = "{{ action('CardsController@getCardsJson') }}";
attributesUrl = "{{ action('CardsController@getCardAttributesJson') }}";
</script>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
{!! Html::script('customJs/angular/cards.js') !!}