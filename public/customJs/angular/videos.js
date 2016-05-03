var videosApp = angular.module('videosApp', ['ui.router']);

videosApp.config(function($stateProvider, $urlRouterProvider){
    $urlRouterProvider.otherwise('filter');

    $stateProvider
    .state('home', {
        url: '',
        templateUrl: "/templates/videos/index",
        controller: "SimpleController"
    })
    .state('filter', {
        url: '/search?page&tag&orderBy&search',
        templateUrl: "/templates/videos/index",
        controller: "SimpleController"
    });
});

videosApp.filter('range', function() {
  return function(input, start, total) {
    total = parseInt(total);

    for (var i=start; i<total; i++) {
      input.push(i);
    }

    return input;
  };
});

videosApp.factory('videoService', function($http) {
    return {
        getVideos: function(queryParams) {
             //return the promise directly.
            return $http({
                    "url" : videosUrl,
                    "method" : "GET",
                    "params" : queryParams
                })
                //resolve the promise as the data
                .then(function(result) {
                    return result.data;
                });
        },
        getVideosByTag: function(tag) {
             //return the promise directly.
            return $http.get(videosUrl)
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
        getVoteResult: function(videoSlug, vote, csrf) {
            var voteUrl = '/videos/' + videoSlug + '/vote';
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

videosApp.controller('SimpleController', ['$scope', '$filter', '$stateParams', '$state', 'videoService', function ($scope, $filter, $stateParams, $state, videoService){
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
    $scope.pagination.videos = {};

    if (sessionStorage.getItem("orderBy") === null) {
        pageService.getOrderBy().then(function(orderBy){
            $scope.orderBy = orderBy;
            sessionStorage.setItem("orderBy", JSON.stringify(orderBy));
        });
    }else{
        $scope.orderBy = JSON.parse(sessionStorage.getItem("orderBy"));
    }

    if (sessionStorage.getItem("tags") === null) {
        videoService.getTags().then(function(tags){
            $scope.tags = tags;
            sessionStorage.setItem("tags", JSON.stringify(tags));
        });
    }else{
        $scope.tags = JSON.parse(sessionStorage.getItem("tags"));
    }

    videoService.getVideos($scope.queryParams).then(function(videos){
        $scope.videos = videos;
        $scope.setPaginationRange();
    });

    $scope.reloadVideos = function(){
        videoService.getVideos($scope.queryParams).then(function(videos){
            $scope.videos = videos;
            $setPaginationRange();
        });
    }

    $scope.vote = function(videoSlug, vote){
        videoService.getVoteResult(videoSlug, vote, $scope.csrf).then(function(changeNumber){
            for(video in $scope.videos.data){
                if($scope.videos.data[video].slug == videoSlug){
                    $scope.videos.data[video].vote_sum = parseInt($scope.videos.data[video].vote_sum) + parseInt(changeNumber);
                    if($scope.videos.data[video].my_vote == null)
                        $scope.videos.data[video].my_vote = parseInt(changeNumber);
                    else
                        $scope.videos.data[video].my_vote = parseInt($scope.videos.data[video].my_vote) + parseInt(changeNumber);
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
        if($scope.videos.last_page < 10){
            $scope.pagination.from = 1,
            $scope.pagination.to = $scope.videos.last_page
        }else {
            // more than 10 to = l videos so calculate start and end videos
            if ($scope.videos.current_page <= 6) {
                $scope.pagination.from = 1,
                $scope.pagination.to = 10
            } else if ($scope.videos.current_page + 4 >= $scope.videos.last_page) {
                $scope.pagination.from = $scope.videos.last_page - 9,
                $scope.pagination.to = $scope.videos.last_page
            } else {
                $scope.pagination.from = $scope.videos.current_page - 5,
                $scope.pagination.to = $scope.videos.current_page + 4
            }
        }
        for(var i = $scope.pagination.from; i <= $scope.pagination.to; i++){
            $scope.pagination.videos[i] = i;
        }
    }
}]);