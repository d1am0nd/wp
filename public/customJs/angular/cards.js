var cardsApp = angular.module('cardsApp', []);

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
        }
    }
});

cardsApp.controller('SimpleController', function ($scope, cardService){
    cardService.getAttributes().then(function(cardAttributes){
        $scope.cardAttributes = cardAttributes;
    });
    cardService.getCards().then(function(cards){
        $scope.cards = cards;
    });

    $scope.search = { 
        "set" : "" ,
        "rarity" : "",
        "class" : "",
    };
});