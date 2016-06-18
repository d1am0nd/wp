app = angular.module('generalApp', ['ui.router', 'ngMessages']);

app.config(function($stateProvider, $urlRouterProvider, $httpProvider){
    $httpProvider.defaults.withCredentials = true;

    $urlRouterProvider
    .otherwise('/');

    $stateProvider
    .state('root', {
        url: '',
        controller: 'RootController'
    })
    .state('home', {
        url: '/',
        templateUrl: '/templates/general/home.html'
    })
    .state('auth', {
        url: '/auth',
        templateUrl: '/templates/auth/register.html',
        controller: 'AuthController'
    })
    .state('logout', {
        url: '/auth/logout',
        controller: 'LogoutController'
    })
    .state('tos', {
        url: '/terms-of-service',
        templateUrl: '/templates/general/tos.html',
    })
});

app.controller('RootController', function($scope, $rootScope, AuthService){
    initController();

    function initController(){
        $scope.token = {};

        AuthService.GetCurrent()
        .then(function(user) {
            if(user)
                $rootScope.user = user;
        });
    }
});