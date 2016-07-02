app = angular.module('generalApp', ['ui.router', 'ngMessages', 'ui.router.metatags']);

app.config(function($stateProvider, $urlRouterProvider, $httpProvider, UIRouterMetatagsProvider){
    $httpProvider.defaults.withCredentials = true;

    UIRouterMetatagsProvider
    .setTitlePrefix('Wizard Poker - ')
    .setDefaultTitle('Wizard Poker')
    .setDefaultDescription('TODO')
    .setStaticProperties({
        'og:site_name' : 'Wizard Poker'
    })
    .setOGURL(true);

    /**
     * Required meta tags: title, description
     * Title is short (displayed: Wizard Poker - {{title}})
     */

    $urlRouterProvider
    .otherwise('/');

    $stateProvider
    .state('home', {
        url: '/',
        templateUrl: '/templates/general/home.html',
        controller: 'HomeController',
        metaTags: {
            description: "Hearthstone cards, pages, videos and more. Share, discuss and rate your favourite Hearthstone content",
            properties: {
                'og:title': "Wizard Poker"
            }
        }
    })
    .state('tos', {
        url: '/terms-of-service',
        templateUrl: '/templates/general/tos.html',
        metaTags: {
            title: "Terms of Service",
            description: "Wizard Poker terms of service",
            properties: {
                'og:title': "Wizard Poker - Terms of Service"
            }
        }
    })
    // Auth
    .state('auth', {
        url: '/auth',
        templateUrl: '/templates/auth/register.html',
        controller: 'AuthController',
        metaTags: {
            title: "Register or Login",
            description: "Register or login",
            properties: {
                'og:title': "Wizard Poker - Register or Login"
            }
        }
    })
    .state('logout', {
        url: '/auth/logout',
        controller: 'LogoutController'
    })
    // Cards
    .state('cards', {
        url: '/cards/search?standard&rarity&class&set&type&page&name&cost',
        templateUrl: '/templates/cards/index.html',
        controller: 'CardsController',
        metaTags: {
            title: "Hearthstone Card Collection",
            description: "A quick responsive card search for collectable Hearthstone cards",
            properties: {
                'og:title': "Wizard Poker - Hearthstone Card Collection"
            }
        }
    })
    // Pages
    .state('pages', {
        url: '/pages/search?page&tag&orderBy&search&type',
        templateUrl: '/templates/pages/index.html',
        controller: 'PagesController',
        metaTags: {
            title: "Hearthstone Pages",
            description: "Share, discuss and rate your favourite Hearthstone content",
            properties: {
                'og:title': "Wizard Poker - Hearthstone Pages"
            }
        }
    })
    .state('page', {
        url: '/pages/:slug',
        templateUrl: '/templates/pages/show.html',
        controller: 'PageController',
        resolve: {
            page: function(PageService, $stateParams) {
                return PageService.GetPage($stateParams.slug);
            }
        },
        metaTags: {
            title: function(page) {
                return page.title
            },
            description: function(page) {
                return page.description
            },
            properties: {
                'og:title': function(page) {
                    return page.title
                }
            }
        }
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

/**
 * Ui-router-metatags setup
 */
app.run(['$rootScope', 'MetaTags', function($rootScope, MetaTags) {
    $rootScope.MetaTags = MetaTags;
}]);