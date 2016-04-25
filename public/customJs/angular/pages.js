var pagesApp = angular.module('pagesApp', []);

pagesApp.factory('pageService', function($http) {
    return {
        getPages: function() {
             //return the promise directly.
            return $http.get(pagesUrl)
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

pagesApp.controller('SimpleController', function ($scope, pageService){
    pageService.getPages().then(function(pages){
        $scope.pages = pages;
    });

    $scope.vote = function(pageSlug, vote){
        pageService.getVoteResult(pageSlug, vote, $scope.csrf).then(function(result){
            var changeNumber = result;
        });
    }
});