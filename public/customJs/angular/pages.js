var pagesApp = angular.module('pagesApp', []);

pagesApp.factory('pageService', function($http) {
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
        getPagesByTag: function(tag) {
             //return the promise directly.
            return $http.get(pagesUrl)
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

pagesApp.controller('SimpleController', function ($scope, $filter, pageService){
    $scope.queryParams = {
        "orderBy" : null,
        "tag" : null
    };


    pageService.getPages($scope.queryParams).then(function(pages){
        $scope.pages = pages;
    });
    pageService.getTags().then(function(tags){
        $scope.tags = tags;
    });

    $scope.$watch(function(scope, filter) { return scope.queryParams.tag; },
            function(newVal, oldVal){
                pageService.getPages($scope.queryParams).then(function(pages){
                    $scope.pages = pages;
                });
            });

    $scope.vote = function(pageSlug, vote){
        pageService.getVoteResult(pageSlug, vote, $scope.csrf).then(function(changeNumber){
            for(page in $scope.pages){
                if($scope.pages[page].slug == pageSlug){
                    $scope.pages[page].vote_sum = parseInt($scope.pages[page].vote_sum) + parseInt(changeNumber);
                    return changeNumber;
                }
            }
            return changeNumber;
        });
    }
});