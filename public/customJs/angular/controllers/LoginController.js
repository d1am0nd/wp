(function () {
    'use strict';

    angular
        .module('generalApp')
        .controller('LoginController', LoginController);

    function LoginController($scope, $rootScope, $window, AuthService){
        initController();

        function initController(){
            AuthService.GetCurrent()
            .then(function(user) {
                if(user)
                    $window.history.back();
            });
        }

        // TODO
        function login() {

        }
    }

})();