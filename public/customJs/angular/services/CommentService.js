(function () {
    'use strict';

    angular
        .module('generalApp')
        .factory('CommentService', Service);

    function Service($http, $q) {
        var service = {};
        var commentsUrl = '/api/comments';

        service.PostVote = PostVote;

        return service;

        function PostVote(id, vote) {
            return $http.post(commentsUrl + '/' + id + '/vote', vote).then(handleSuccess, handleError);
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