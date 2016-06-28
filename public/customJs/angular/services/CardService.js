(function () {
    'use strict';

    angular
        .module('generalApp')
        .factory('CardService', Service);

    function Service($http, $q) {
        var service = {};
        var cardsUrl = '/api/cards';
        var attributesUrl = '/api/cards/attributes';

        service.GetCards = GetCards;
        service.GetAttributes = GetAttributes;

        return service;

        function GetCards() {
            return $http.get(cardsUrl).then(handleSuccess, handleError);
        }

        function GetAttributes() {
            return $http.get(attributesUrl).then(handleSuccess, handleError);
        }
        

        // private functions
        function handleSuccess(res) {
            return res.data;
        }

        function handleError(res) {
            return $q.reject(res.data);
        }
    }

})();