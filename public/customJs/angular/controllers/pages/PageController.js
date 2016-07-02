(function () {
    'use strict';

    angular
        .module('generalApp')
        .controller('PageController', PageController);

    function PageController($scope, $rootScope, $state, $stateParams, PageService, CommentService, page) {
        initController();

        function initController() {
            if(!page)
                console.log('ni'); // #TODO: 404

            $scope.comment = {};
            $scope.page = page; // Get from resolve
            $scope.postComment = postComment; 
            $scope.vote = vote;
        }

        function postComment(comment) {
            comment._token = $rootScope.token.csrf;

            PageService.PostComment($scope.page.slug, comment)
            .then(function(comment) {
                $scope.page.comments.unshift(comment); // Adds new comment to the front of array
            });
        }

        function vote(comment, vote) {
            var vote = {
                "_token": $rootScope.token.csrf,
                "vote": vote
            };

            CommentService.PostVote(comment.id, vote)
            .then(function(changeNumber) {
                comment.vote_sum = parseInt(comment.vote_sum) + parseInt(changeNumber);
                comment.my_vote = parseInt(comment.my_vote) + parseInt(changeNumber);
            });
        }

    }
})();