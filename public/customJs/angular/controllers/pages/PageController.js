(function () {
    'use strict';

    angular
        .module('generalApp')
        .controller('PageController', PageController);

    function PageController($scope, $rootScope, $window, AuthService) {
        initController();

        function initController(){
            console.log('test');
        }

    }
})();