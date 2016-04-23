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
                @foreach($cardAttributes['rarities'] as $rarity)
                <div class="col-sm-4 col-xs-4">
                    <div class="margin-bottom-15">
                        <button class="btn btn-u" data-ng-model="rarities">{{ $rarity }}</button>
                    </div>
                </div>
                @endforeach
                <div data-ng-repeat="rarity in rarities">@{{ rarity }}</div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3>Sets</h3>
                </div>
                @foreach($cardAttributes['sets'] as $set)
                <div class="col-sm-4 col-xs-4">
                    <div class="margin-bottom-15">
                        <button class="btn btn-u">{{ $set }}</button>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3>Classes</h3>
                </div>
                @foreach($cardAttributes['classes'] as $class)
                <div class="col-sm-4 col-xs-4">
                    <div class="margin-bottom-15">
                        <button class="btn btn-u">{{ $class }}</button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-sm-3 col-xs-6" data-ng-repeat="card in cards | filter:search | filter:rarities | limitTo:28 | orderBy:'name'">
                    <img class="img-responsive" src="@{{ card.image_path }}">
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('foot')
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
<script>
url = "http://localhost:8000/cards";
var cardsApp = angular.module('cardsApp', []);

cardsApp.factory('cardService', function($http) {
    return {
        getCards: function() {
             //return the promise directly.
            return $http.get(url)
                //resolve the promise as the data
                .then(function(result) {
                    return result.data;
                });
        }
    }
});

cardsApp.controller('SimpleController', function ($scope, cardService){
    cardService.getCards().then(function(cards){
        $scope.cards = cards;
    });
});
</script>
