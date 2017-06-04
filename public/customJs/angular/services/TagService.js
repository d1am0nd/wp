(function () {
    'use strict';

    angular
        .module('generalApp')
        .factory('TagService', Service);

    function Service($http, $q) {
        var service = {};
        var tagsUrl = '/api/tags';

        service.GetTags = GetTags;

        return service;

        function GetTags() {
            return $http.get(tagsUrl).then(handleSuccess, handleError);
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