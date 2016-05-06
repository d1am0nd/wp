var cardsApp = angular.module('cardsApp', ['ui.router']);

cardsApp.config(function($stateProvider, $urlRouterProvider){
    $urlRouterProvider.otherwise('filter');

    $stateProvider
    .state('home', {
        url: '',
        templateUrl: "/templates/cards/index",
        controller: "SimpleController"
    })
    .state('filter', {
        url: '/search?standard&rarity&class&set&type&page&name&cost',
        templateUrl: "/templates/cards/index",
        controller: "SimpleController"
    });
});

cardsApp.filter('cost', function(){
    return function(cards, costFilter){
        /**
         * If filter is undefined,
         * return all cards
         */
        if(costFilter == undefined)
            return cards;

        /**
         * Otherwise return filtered cards
         */
        var filtered = [];
        if(costFilter == '7+'){
        console.log(costFilter);
            cards.forEach(function(card){
                if(parseInt(card.cost) > 6)
                    filtered.push(card);
            });
        }else{
            cards.forEach(function(card){
                if(parseInt(card.cost) == costFilter)
                    filtered.push(card);
            });
        }
        return filtered;
    }
});


cardsApp.factory('cardService', function($http) {
    return {
        getCards: function() {
             //return the promise directly.
            return $http.get(cardsUrl)
                //resolve the promise as the data
                .then(function(result) {
                    return result.data;
                });
        },
        getAttributes: function() {
            return $http.get(attributesUrl)
                .then(function(result) {
                    return result.data;
                });
        },
        /**
         * Inits attributeClasses object. Sets all classes
         * to empty string.
         */
        getAttributeClasses: function(attributes, picked = null) {
            var attributeClasses = {};
            $.each(attributes, function(attribute, values){
                attributeClasses[attribute] = {};
                $.each(values, function(dbName, prettyName){
                    if(picked == dbName)
                        attributeClasses[attribute][dbName] = "btn-u-sea";
                    else
                        attributeClasses[attribute][dbName] = "";
                });
            });
            return attributeClasses;
        }
    }
});

cardsApp.controller('SimpleController', function ($scope, $filter, $state, $stateParams, cardService){

    $scope.limit = 28;

    $scope.pagination = {};
    $scope.pagination.currentPage = $stateParams.page ? $stateParams.page : 1;
    $scope.pagination.pages = {};

    $scope.costs = [0, 1, 2, 3, 4, 5, 6, "7+"];

    $scope.search = {
        "isStd" : $stateParams.standard,
        "rarity" : $stateParams.rarity,
        "class" : $stateParams.class,
        "set" : $stateParams.set,
        "type" : $stateParams.type,
        "name" : undefined,
    }
    $scope.cost = $stateParams.cost;

    $scope.originalSearchName = $stateParams.name;

    /**
     * Change state to new searched state
     *
     * Currently not in use cause more trouble than awesomeness
     */
    $scope.searchNameChanged = function(){
        $state.go('filter',{
            page : undefined, 
            type : $scope.search.type, 
            set: $scope.search.set, 
            class : $scope.search.class, 
            rarity : $scope.search.rarity, 
            standard : $scope.search.isStd,
            name : $scope.search.name,
            cost : $scope.cost
        });
    }

    /**
     * Filter cards and reset limit.
     */
    $scope.updateFiltered = function(){
        $scope.filteredCards = $filter('filter')($scope.cards, $scope.search);
        $scope.filteredCards = $filter('cost')($scope.filteredCards, $scope.cost);
        $scope.setPaginationRange();
    }

    /**
     * Sets pagination range. 
     * From, to, current page, last page
     */
    $scope.setPaginationRange = function(){
        var lastPage = Math.ceil($scope.filteredCards.length / $scope.limit);
        var currentPage = $scope.pagination.currentPage ? parseInt($scope.pagination.currentPage) : 1;

        $scope.pagination.lastPage = lastPage;
        $scope.limitTo = currentPage * $scope.limit;
        $scope.limitFrom = (currentPage - 1) * $scope.limit;

        if(lastPage < 10){
            $scope.pagination.from = 1,
            $scope.pagination.to = lastPage
        }else {
            // more than 10 to = l pages so calculate start and end pages
            if (currentPage <= 6) {
                $scope.pagination.from = 1;
                $scope.pagination.to = 10;
            } else if (currentPage + 4 >= lastPage) {
                $scope.pagination.from = lastPage - 9;
                $scope.pagination.to = lastPage;
            } else {
                $scope.pagination.from = currentPage - 5;
                $scope.pagination.to = currentPage + 4;
            }
        }
    }

    /**
     * Return array of pages to display in pagination
     */
    $scope.getPaginationPages = function(){
        var pages = [];
        for(var i = $scope.pagination.from; i <= $scope.pagination.to; i++){
            pages.push(i);
        }
        return pages;
    }

    /**
     * Checks sessionStorage for cardAttributes. If none is found
     * fetch them from db
     */
    if (sessionStorage.getItem("cardAttributes") === null) {
        cardService.getAttributes().then(function(cardAttributes){
            $scope.cardAttributes = cardAttributes;
            $scope.cardAttributeClasses = cardService.getAttributeClasses(cardAttributes);
            sessionStorage.setItem("cardAttributes", JSON.stringify(cardAttributes));
        });

    }else{
        $scope.cardAttributes = JSON.parse(sessionStorage.getItem("cardAttributes"));
        $scope.cardAttributeClasses = cardService.getAttributeClasses($scope.cardAttributes);
    }

    /**
     * Checks sessionStorage for cards. If none is found
     * fetch them from db
     */
    if (sessionStorage.getItem("cards") === null) {
        cardService.getCards().then(function(cards){
            $scope.cards = cards;
            $scope.updateFiltered();
            sessionStorage.setItem("cards", JSON.stringify(cards));
        });

    }else{
        $scope.cards = JSON.parse(sessionStorage.getItem("cards"));
        $scope.updateFiltered();
    }
});