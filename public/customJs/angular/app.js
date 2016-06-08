app = angular.module('generalApp', ['ui.router']);

app.config(function($stateProvider, $urlRouterProvider){
    $urlRouterProvider
    .otherwise('/');

    $stateProvider
    .state('home', {
        url: '/',
        templateUrl: '/templates/general/home.html',
        controller: 'RootController'
    })
    .state('login', {
        url: '/login',
        templateUrl: '/templates/auth/login.html',
        //controller: 'LoginController'
    })
    .state('register', {
        url: '/register',
        templateUrl: '/templates/auth/register.html',
        //controller: 'RegisterController'
    })
    .state('tos', {
        url: '/terms-of-service',
        templateUrl: '/templates/general/tos.html',
    })
});

app.controller('RootController', function($scope, $rootScope){
    initController();

    function initController(){
        console.log('works');
    }

    function logout(){

    }
});