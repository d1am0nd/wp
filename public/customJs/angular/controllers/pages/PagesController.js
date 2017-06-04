(function () {
    'use strict';

    angular
        .module('generalApp')
        .controller('PagesController', PagesController)

    function PagesController($scope, $rootScope, $filter, $stateParams, $state, PageService) {
        $scope.queryParams = {
            "orderBy" : $stateParams.orderBy,
            "tag" : $stateParams.tag,
            "page" : $stateParams.page,
            "title" : $stateParams.search,
            "type" : $stateParams.type
        };
        $scope.orderByFilter = 'top';
        $scope.search = {};
        $scope.search.title = '';
        $scope.pagination = {};
        $scope.pagination.pages = {};
        $scope.types = [
            { name: "Website" }, 
            { name: "Video" },
            { name: "Channel" }
        ];
        /**
         * TODO: Seperate into a service
         */
        if (sessionStorage.getItem("orderBy") === null) {
            PageService.GetOrderBy().then(function(orderBy){
                $scope.orderBy = orderBy;
                sessionStorage.setItem("orderBy", JSON.stringify(orderBy));
            });
        }else{
            $scope.orderBy = JSON.parse(sessionStorage.getItem("orderBy"));
        }

        if (sessionStorage.getItem("tags") === null) {
            PageService.GetTags().then(function(tags){
                $scope.tags = tags;
                sessionStorage.setItem("tags", JSON.stringify(tags));
            });
        }else{
            $scope.tags = JSON.parse(sessionStorage.getItem("tags"));
        }

        PageService.GetPages($scope.queryParams).then(function(pages){
            $scope.pages = pages;
            $scope.setPaginationRange();
        });

        $scope.reloadPages = function(){
            PageService.GetPages($scope.queryParams).then(function(pages){
                $scope.pages = pages;
                $setPaginationRange();
            });
        }

        $scope.vote = function(page, vote){
            if(!$rootScope.user)
                $state.go('auth');

            var pageSlug = page.slug;
            vote = {
                "vote": vote,
                "_token": $rootScope.token.csrf
            };

            PageService.Vote(pageSlug, vote).then(function(changeNumber){
                page.vote_sum = parseInt(page.vote_sum) + parseInt(changeNumber);
                page.my_vote = parseInt(page.my_vote) + parseInt(changeNumber);

                console.log(page.my_vote);

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
                type: $scope.queryParams.type,
                page: undefined
            });
        }

        /**
         * TODO: Seperate into a service
         */
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
    }

})();