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
    <h1 class="margin-bottom-10">Hearthstone Card Collection</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="row margin-bottom-10">
                <div class="col-md-12">
                    <h3>Search by name:</h3>
                    <input type="text" data-ng-model="search.name" ng-change="updateFiltered()"/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3>Rarities</h3>
                </div>
                <div class="col-sm-4 col-xs-4">
                    <div class="margin-bottom-15">
                        <button class="btn-u btn-u-green" style="width:100;" ng-click="search.rarity = ''; setAttributeClass('rarities');">ALL</button>
                    </div>
                </div>
                <div class="col-sm-4 col-xs-4" data-ng-repeat="(searchTerm, name) in cardAttributes.rarities">
                    <div class="margin-bottom-15">
                        <button class="btn-u" style="width:100;" ng-class="cardAttributeClasses.rarities[searchTerm]"  ng-click="search.rarity = searchTerm; setAttributeClass('rarities', searchTerm);">@{{ name }}</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3>Classes</h3>
                </div>
                <div class="col-sm-4 col-xs-4">
                    <div class="margin-bottom-15">
                        <button class="btn-u btn-u-green" style="width:100;" ng-click="search.class = ''; setAttributeClass('classes');">ALL</button>
                    </div>
                </div>
                <div class="col-sm-4 col-xs-4" data-ng-repeat="(searchTerm, name) in cardAttributes.classes">
                    <div class="margin-bottom-15">
                        <button class="btn-u" style="width:100;" ng-class="cardAttributeClasses.classes[searchTerm]"  ng-click="search.class = searchTerm; setAttributeClass('classes', searchTerm);">@{{ name }}</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3>Sets</h3>
                </div>
                <div class="col-sm-4 col-xs-4">
                    <div class="margin-bottom-15">
                        <button class="btn-u btn-u-green" style="width:100;" ng-click="search.set = ''; setAttributeClass('sets');">ALL</button>
                    </div>
                </div>
                <div class="col-sm-4 col-xs-4" data-ng-repeat="(searchTerm, name) in cardAttributes.sets">
                    <div class="margin-bottom-15">
                        <button class="btn-u" style="width:100;" ng-class="cardAttributeClasses.sets[searchTerm]" ng-click="search.set = searchTerm; setAttributeClass('sets', searchTerm);">@{{ name }}</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h3>Types</h3>
                </div>
                <div class="col-sm-4 col-xs-4">
                    <div class="margin-bottom-15">
                        <button class="btn-u btn-u-green" style="width:100;" ng-click="search.type = ''; setAttributeClass('types');">ALL</button>
                    </div>
                </div>
                <div class="col-sm-4 col-xs-4" data-ng-repeat="(searchTerm, name) in cardAttributes.types">
                    <div class="margin-bottom-15">
                        <button class="btn-u" style="width:100;" ng-class="cardAttributeClasses.types[searchTerm]" ng-click="search.type = searchTerm; setAttributeClass('types', searchTerm);">@{{ name }}</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-sm-3 col-xs-6" data-ng-repeat="card in filteredCards | orderBy:'name' | limitTo:limit">
                    <img title="@{{ card.name }}" class="img-responsive" src="@{{ card.image_path }}">
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4 col-xs-offset-4">
                    <button class="btn btn-u btn-u-sea btn-u-lg" type="button" ng-click="increaseLimit()">Show more</button>
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