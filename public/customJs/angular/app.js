app = angular.module('generalApp', ['ui.router', 'ngMessages']);

app.config(function($stateProvider, $urlRouterProvider, $httpProvider){
    $httpProvider.defaults.withCredentials = true;

    $urlRouterProvider
    .otherwise('/');

    $stateProvider
    .state('home', {
        url: '/',
        templateUrl: '/templates/general/home.html',
        controller: 'HomeController'
    })
    .state('tos', {
        url: '/terms-of-service',
        templateUrl: '/templates/general/tos.html',
    })
    // Auth
    .state('auth', {
        url: '/auth',
        templateUrl: '/templates/auth/register.html',
        controller: 'AuthController'
    })
    .state('logout', {
        url: '/auth/logout',
        controller: 'LogoutController'
    })
    // Cards
    .state('cards', {
        url: '/cards/search?standard&rarity&class&set&type&page&name&cost',
        templateUrl: '/templates/cards/index.html',
        controller: 'CardsController'
    })
    // Pages
    .state('pages', {
        url: '/pages/search?page&tag&orderBy&search&type',
        templateUrl: '/templates/pages/index.html',
        controller: 'PagesController'
    })
    .state('page', {
        url: '/pages/:slug',
        templateUrl: '/templates/pages/show.html',
        controller: 'PageController'
    });
});

app.controller('RootController', function($rootScope, AuthService){
    initController();

    function initController(){
        $rootScope.token = {};

        AuthService.GetCurrent()
        .then(function(user) {
            if(user)
                $rootScope.user = user;
        });
    }
});