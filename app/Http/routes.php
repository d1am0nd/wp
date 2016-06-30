<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::get('', 'GeneralController@getHome');
    Route::get('logout', 'Auth\AuthController@getLogout');
    Route::post('login', 'Auth\AuthController@postLogin');
    Route::post('register', 'Auth\AuthController@postRegister');

    Route::get('account/username/edit', 'AccountsController@getUsernameEdit');
    Route::post('account/username/edit', 'AccountsController@postUsernameEdit');
    Route::get('account/username/confirm', 'AccountsController@getConfirmUsername');

    Route::get('auth/{provider}', 'AuthController@redirectToProvider');
    Route::get('auth/{provider}/callback', 'AuthController@handleProviderCallback');

    Route::get('pages', 'PagesController@index');
    Route::post('pages', 'PagesController@store');
    Route::get('pages/{pageSlug}', 'PagesController@show');
    // Route::post('pages/{page}/comment', 'PagesController@postComment');

    Route::get('videos', 'VideosController@index');
    Route::post('videos', 'VideosController@store');
    Route::get('videos/{video}', 'VideosController@show');
    Route::post('videos/{video}/comment', 'VideosController@postComment');
    Route::post('videos/{video}/vote', 'VideosController@postVote');

    Route::post('comments/{id}/vote', 'CommentsController@postVote');

    Route::get('templates/pages/index', 'PagesController@getPagesTemplate');
    Route::get('templates/videos/index', 'VideosController@getVideosTemplate');
    Route::get('templates/cards/index', 'CardsController@getCardsTemplate');

    Route::get('terms-of-service', 'GeneralController@getTos');

    Route::get('sitemap.xml', 'GeneralController@getSitemapXml');

    Route::get('zohoverify/verifyforzoho.html', function()
    {
        return response('1460414100837')->header('Content-Type', 'text/html');
    });

    Route::get('cards', 'CardsController@index');

    Route::get('api/users/current', 'AuthController@getCurrentUser');
    Route::post('api/users/login', 'AuthController@postLogin');
    Route::post('api/users/create', 'AuthController@postCreateUser');
    Route::get('api/users/logout', 'AuthController@getLogout');

    Route::get('api/cards', 'CardsController@getCardsJson');
    Route::get('api/cards/attributes', 'CardsController@getCardAttributesJson');

    Route::get('api/pages', 'PagesController@getPagesJson');
    Route::get('api/pages/{slug}', 'PagesController@getPageJson');
    Route::post('api/pages/{slug}/comment', 'PagesController@postComment');
    Route::post('api/pages/{slug}/vote', 'PagesController@postVote');

    Route::post('api/comments/{id}/vote', 'CommentsController@postVote');

    Route::get('api/videos', 'VideosController@getVideosJson');

    Route::get('api/tags', 'TagsController@getTagsJson');

    Route::get('api/orderBy', 'GeneralController@getOrderByJson');
    /**
     * Next routes are for development purposes only
     */
    // Route::get('ang/pages', 'PagesController@getPages');
    // Route::get('ang/videos', 'VideosController@getVideos');
});