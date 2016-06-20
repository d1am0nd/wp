(function () {
    'use strict';

    angular
        .module('generalApp')
        .factory('PageService', Service);

    function Service($http, $q) {
        var service = {};
        var pagesUrl = '/api/pages';
        var tagsUrl = '/api/tags';
        var orderByUrl = '/api/orderBy';

        service.GetPages = GetPages;
        service.GetTags = GetTags;
        service.GetOrderBy = GetOrderBy;
        service.Vote = Vote;

        return service;

        function GetPages(queryParams) {
            return $http.get(pagesUrl, queryParams).then(handleSuccess, handleError);
        }

        function GetTags() {
            return $http.get(tagsUrl).then(handleSuccess, handleError);
        }

        function GetOrderBy() {
            return $http.get(orderByUrl).then(handleSuccess, handleError);
        }

        function Vote(pageSlug, vote) {
            return $http.get('/pages/' + pageSlug + '/vote', vote).then(handleSuccess, handleError);
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

/*
app.factory('pageService', function($http) {
    var pagesUrl = '/api/pages'
    return {
        getPages: function(queryParams) {
             //return the promise directly.
            return $http({
                    "url" : pagesUrl,
                    "method" : "GET",
                    "params" : queryParams
                })
                //resolve the promise as the data
                .then(function(result) {
                    return result.data;
                });
        },
        getTags: function() {
             //return the promise directly.
            return $http.get(tagsUrl)
                //resolve the promise as the data
                .then(function(result) {
                    return result.data;
                });
        },
        getOrderBy: function() {
             //return the promise directly.
            return $http.get(orderByUrl)
                //resolve the promise as the data
                .then(function(result) {
                    return result.data;
                });
        },
        getVoteResult: function(pageSlug, vote, csrf) {
            var voteUrl = '/pages/' + pageSlug + '/vote';
            var data = {
                "vote" : vote,
                __token : csrf
            };
             //return the promise directly.
            return $http.post(voteUrl, data)
                //resolve the promise as the data
                .then(function(result) {
                    return result.data;
                });l
        },
    }
});
*/