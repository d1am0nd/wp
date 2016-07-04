(function () {
    'use strict';

    angular
        .module('generalApp')
        .controller('PageCreateController', PageCreateController);

    function PageCreateController($scope, $rootScope, $window, PageService, TagService) {
        initController();

        function initController() {
            $scope.page = {};
            $scope.page['tag_id'] = [];

            $scope.submitPage = submitPage;
            $scope.isTagIdChecked = isTagIdChecked;
            $scope.toggleTagId = toggleTagId;

            TagService.GetTags()
            .then(function(tags) {
                $scope.tags = tags;
            });
        }

        function submitPage(page) {
            page._token = $rootScope.token.csrf;

            PageService.CreatePage(page)
            .then(function(page) {
                $window.history.back();
            })
            .catch(function(err) {

            });
        }

        function isTagIdChecked(id) {
            return $scope.page['tag_id'].indexOf(id) > -1;
        }

        function toggleTagId(id) {
            var indexOfId = $scope.page['tag_id'].indexOf(id);

            if(indexOfId == -1){
                $scope.page['tag_id'].push(id);
            }
            else {
                $scope.page['tag_id'].splice(indexOfId);
            }
        }
    }
})();