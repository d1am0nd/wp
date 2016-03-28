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
    Route::get('', function(){
        return redirect(action('PagesController@index'));
    });
    Route::get('logout', 'Auth\AuthController@getLogout');
    Route::post('login', 'Auth\AuthController@postLogin');
    Route::post('register', 'Auth\AuthController@postRegister');

    Route::get('pages', 'PagesController@index');
    Route::post('pages', 'PagesController@store');
    Route::post('pages/{page}', 'PagesController@postVote');

    Route::get('videos', 'VideosController@index');
    Route::post('videos', 'VideosController@store');
    Route::post('videos/{video}', 'VideosController@postVote');

    Route::get('privacy-policy', 'GeneralController@getPrivacyPolicy');

    /*
    Route::get('tags', 'TagsController@index');
    Route::get('tags/{tag}', 'TagsController@show');
    */

    Route::get('sitemap.xml', 'GeneralController@getSitemapXml');
});