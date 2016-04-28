var videosApp = angular.module('videosApp', []);

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

videosApp.controller('SimpleController', function ($scope, $filter, videoService){
    $scope.queryParams = {
        "orderBy" : 'top',
        "tag" : null,
    };
    $scope.orderByFilter = 'top';

    if (sessionStorage.getItem("orderBy") === null) {
        videoService.getOrderBy().then(function(orderBy){
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
    });

    $scope.$watch(function(scope, filter) { return scope.queryParams.tag; },
            function(newVal, oldVal){
                videoService.getVideos($scope.queryParams).then(function(videos){
                    $scope.videos = videos;
                });
            });

    $scope.$watch(function(scope, filter) { return scope.queryParams.orderBy; },
            function(newVal, oldVal){
                videoService.getVideos($scope.queryParams).then(function(videos){
                    $scope.videos = videos;
                });
            });

    $scope.vote = function(videoSlug, vote){
        videoService.getVoteResult(videoSlug, vote, $scope.csrf).then(function(changeNumber){
            for(video in $scope.videos){
                if($scope.videos[video].slug == videoSlug){
                    $scope.videos[video].vote_sum = parseInt($scope.videos[video].vote_sum) + parseInt(changeNumber);
                    $scope.videos[video].my_vote = parseInt($scope.videos[video].my_vote) + parseInt(changeNumber);
                    return changeNumber;
                }
            }
            return changeNumber;
        });
    }

    $scope.clearTitleSearch = function(){
        $scope.search.title = '';
        $scope.queryParams.title = '';

        videoService.getVideos($scope.queryParams).then(function(videos){
            $scope.videos = videos;
        });
    }

    $scope.getByTitle = function(){
        $scope.queryParams.title = $scope.search.title;

        videoService.getVideos($scope.queryParams).then(function(videos){
            $scope.videos = videos;
        });
    }
});