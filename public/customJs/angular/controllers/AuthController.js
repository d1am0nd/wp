(function () {
    'use strict';

    angular
        .module('generalApp')
        .controller('AuthController', AuthController)
        .controller('LogoutController', LogoutController);

    function AuthController($scope, $rootScope, $window, AuthService) {
        initController();

        function initController(){
            $scope.submitRegister = submitRegister;
            $scope.submitLogin = submitLogin;

            AuthService.GetCurrent()
            .then(function(user) {
                //if(user)
                    //$window.history.back();
            });
        }

        function submitRegister(user) {
            user._token = $rootScope.token.csrf;
            console.log(user);

            AuthService.PostRegister(user)
            .then(function(user) {
                $rootScope.user = user;
                $window.history.back();
            })
            .catch(function(err) {
            });
        }

        function submitLogin(user) {
            user._token = $rootScope.token.csrf;

            AuthService.PostLogin(user)
            .then(function(user) {
                $rootScope.user = user;
                $window.history.back();
            })
            .catch(function(err) {
            });
        }
    }

    function LogoutController($rootScope, $window, AuthService) {
        AuthService.GetLogout()
        .then(function() {
            $rootScope.user = undefined;
            $window.history.back();
        });
    }

})();