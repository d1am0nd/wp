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
        service.GetPage = GetPage;
        service.PostComment = PostComment;

        return service;

        function GetPages(queryParams) {
            return $http.get(pagesUrl, queryParams).then(handleSuccess, handleError);
        }

        function GetPage(slug) {
            return $http.get('/api/pages/' + slug).then(handleSuccess, handleError);
        }

        function GetTags() {
            return $http.get(tagsUrl).then(handleSuccess, handleError);
        }

        function GetOrderBy() {
            return $http.get(orderByUrl).then(handleSuccess, handleError);
        }

        function Vote(pageSlug, vote) {
            return $http.post('/api/pages/' + pageSlug + '/vote', vote).then(handleSuccess, handleError);
        }

        function PostComment(pageSlug, comment) {
            return $http.post('api/pages/' + pageSlug + '/comment', comment).then(handleSuccess, handleError);
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