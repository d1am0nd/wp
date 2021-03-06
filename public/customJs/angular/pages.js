var pagesApp = angular.module('pagesApp', ['ui.router']);

pagesApp.config(function($stateProvider, $urlRouterProvider){
    $urlRouterProvider.otherwise('filter');

    $stateProvider
    .state('home', {
        url: '',
        templateUrl: "/templates/pages/index",
        controller: "SimpleController"
    })
    .state('filter', {
        url: '/search?page&tag&orderBy&search',
        templateUrl: "/templates/pages/index",
        controller: "SimpleController"
    });
});

pagesApp.filter('range', function() {
  return function(input, start, total) {
    total = parseInt(total);

    for (var i=start; i<total; i++) {
      input.push(i);
    }

    return input;
  };
});

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

pagesApp.controller('SimpleController', ['$scope', '$filter', '$stateParams', '$state', 'pageService', function ($scope, $filter, $stateParams, $state, pageService){
    $scope.queryParams = {
        "orderBy" : $stateParams.orderBy,
        "tag" : $stateParams.tag,
        "page" : $stateParams.page,
        "title" : $stateParams.search
    };
    $scope.orderByFilter = 'top';
    $scope.search = [];
    $scope.search.title = '';
    $scope.pagination = {};
    $scope.pagination.pages = {};

    if (sessionStorage.getItem("orderBy") === null) {
        pageService.getOrderBy().then(function(orderBy){
            $scope.orderBy = orderBy;
            sessionStorage.setItem("orderBy", JSON.stringify(orderBy));
        });
    }else{
        $scope.orderBy = JSON.parse(sessionStorage.getItem("orderBy"));
    }

    if (sessionStorage.getItem("tags") === null) {
        pageService.getTags().then(function(tags){
            $scope.tags = tags;
            sessionStorage.setItem("tags", JSON.stringify(tags));
        });
    }else{
        $scope.tags = JSON.parse(sessionStorage.getItem("tags"));
    }

    pageService.getPages($scope.queryParams).then(function(pages){
        $scope.pages = pages;
        $scope.setPaginationRange();
    });

    $scope.reloadPages = function(){
        pageService.getPages($scope.queryParams).then(function(pages){
            $scope.pages = pages;
            $setPaginationRange();
        });
    }

    $scope.vote = function(pageSlug, vote){
        pageService.getVoteResult(pageSlug, vote, $scope.csrf).then(function(changeNumber){
            for(page in $scope.pages.data){
                if($scope.pages.data[page].slug == pageSlug){
                    $scope.pages.data[page].vote_sum = parseInt($scope.pages.data[page].vote_sum) + parseInt(changeNumber);
                    if($scope.pages.data[page].my_vote == null)
                        $scope.pages.data[page].my_vote = parseInt(changeNumber);
                    else
                        $scope.pages.data[page].my_vote = parseInt($scope.pages.data[page].my_vote) + parseInt(changeNumber);
                    return changeNumber;
                }
            }
            return changeNumber;
        });
    }

    $scope.clearTitleSearch = function(){
        $scope.search.title = '';
        $scope.queryParams.title = '';

        $scope.getByTitle();
    }

    $scope.getByTitle = function(){
        $state.go('filter',{
            orderBy : $scope.queryParams.orderBy,
            tag: $scope.queryParams.tag,
            search: $scope.search.title,
            page: undefined
        });
    }

    $scope.setPaginationRange = function(){
        if($scope.pages.last_page < 10){
            $scope.pagination.from = 1,
            $scope.pagination.to = $scope.pages.last_page
        }else {
            // more than 10 to = l pages so calculate start and end pages
            if ($scope.pages.current_page <= 6) {
                $scope.pagination.from = 1,
                $scope.pagination.to = 10
            } else if ($scope.pages.current_page + 4 >= $scope.pages.last_page) {
                $scope.pagination.from = $scope.pages.last_page - 9,
                $scope.pagination.to = $scope.pages.last_page
            } else {
                $scope.pagination.from = $scope.pages.current_page - 5,
                $scope.pagination.to = $scope.pages.current_page + 4
            }
        }
    }

    $scope.getPaginationPages = function(){
        var pages = [];
        for(var i = $scope.pagination.from; i <= $scope.pagination.to; i++){
            pages.push(i);
        }
        return pages;
    }
}]);