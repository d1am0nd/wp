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
        },
        /**
         * Inits attributeClasses object. Sets all classes
         * to empty string.
         */
        getAttributeClasses: function(attributes, picked = null) {
            var attributeClasses = {};
            console.log(attributes);
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

cardsApp.controller('SimpleController', function ($scope, $filter, cardService){

    $scope.limit = 28;

    /**
     * Checks sessionStorage for cardAttributes. If none is found
     * fetch them from db
     */
    //if (sessionStorage.getItem("cardAttributes") === null) {
        cardService.getAttributes().then(function(cardAttributes){
            $scope.cardAttributes = cardAttributes;
            $scope.cardAttributeClasses = cardService.getAttributeClasses(cardAttributes);
            sessionStorage.setItem("cardAttributes", JSON.stringify(cardAttributes));
        });
        /*
    }else{
        $scope.cardAttributes = JSON.parse(sessionStorage.getItem("cardAttributes"));
        $scope.cardAttributeClasses = cardService.getAttributeClasses($scope.cardAttributes);
    }
    */

    /**
     * Checks sessionStorage for cards. If none is found
     * fetch them from db
     */
    //if (sessionStorage.getItem("cards") === null) {
        cardService.getCards().then(function(cards){
            $scope.cards = cards;
            $scope.filteredCards = cards;
            sessionStorage.setItem("cards", JSON.stringify(cards));
        });
      /*  
    }else{
        $scope.cards = JSON.parse(sessionStorage.getItem("cards"));
        $scope.filteredCards = $scope.cards;
    }
    */
    /**
     * Sets all attribute's classes to "", unless 2nd var is passed 
     * in which case set this class to "sea" color, indicating that
     * cards are filtered by it
     */
    $scope.setAttributeClass = function(attribute, picked = null){
        $.each($scope.cardAttributeClasses[attribute], function(dbName, prettyName){
            if(picked == dbName)
                $scope.cardAttributeClasses[attribute][dbName] = "btn-u-sea";
            else
                $scope.cardAttributeClasses[attribute][dbName] = "";
        });
        $scope.updateFiltered();
    }
    /**
     * Simple helpers for increasing/decreasing number of cards visible
     */
    $scope.increaseLimit = function(){
        $scope.limit += 20;
        var maxNumber = $scope.filteredCards.length;
        if($scope.limit > maxNumber)
            $scope.limit = maxNumber;
    }
    /**
     * Filter cards and reset limit.
     */
    $scope.updateFiltered = function(){
        $scope.filteredCards = $filter('filter')($scope.cards, $scope.search);
        $scope.limit = 28;
    }

    /**
     * Default search shows everything
     */
    $scope.search = { 
    };
});