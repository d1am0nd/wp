(function () {
    'use strict';

    angular
        .module('generalApp')
        .factory('AuthService', Service);

    function Service($http, $q) {
        var service = {};

        service.GetCurrent = GetCurrent;
        service.PostLogin = PostLogin;
        service.PostRegister = PostRegister;
        service.GetLogout = GetLogout;

        return service;

        function GetCurrent() {
            return $http.get('/api/users/current').then(handleSuccess, handleError);
        }

        function PostLogin(user) {
            return $http.post('/api/users/login', user).then(handleSuccess, handleError);
        }

        function PostRegister(user) {
            return $http.post('/api/users/create', user).then(handleSuccess, handleError);
        }

        function GetLogout() {
            return $http.get('/api/users/logout').then(handleSuccess, handleError);
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
