(function () {
    'use strict';

    angular
        .module('generalApp')
        .controller('PageController', PageController);

    function PageController($scope, $rootScope, $state, $stateParams, PageService) {
        initController();

        function initController(){
            PageService.GetPage($stateParams.slug)
            .then(function(page) {
                if(page)
                    $scope.page = page;
                else
                    $state.go('404');
            })
        }

    }
})();