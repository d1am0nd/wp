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

Route::get('test', function () {
    return App\Models\Cards\Card::leftJoin('classes', 'cards.class_id', '=', 'classes.id')
        /**
         * Each card must have these.
         * If it doesn't, the cards entry must be corrupted.
         */
        ->join('card_rarities', 'cards.card_rarity_id', '=', 'card_rarities.id')
        ->join('card_sets', 'cards.card_set_id', '=', 'card_sets.id')
        ->join('card_types', 'cards.card_type_id', '=', 'card_types.id')
        ->join('card_texts', 'cards.id', '=', 'card_texts.card_id')
        ->join('card_languages', function($q){
            $q->on('card_texts.card_language_id', '=', 'card_languages.id')
                ->where('card_languages.lang_id', '=', 'enUS');
        })
        ->select([
            'cards.id',
            'cards.card_id',
            'cards.image_path',
            'cards.cost',
            'cards.hp',
            'cards.atk',
            'card_rarities.name as rarity',
            'card_sets.name as set',
            'card_sets.is_standard as isStd',
            'card_types.name as type',
            'card_texts.name as name',
            'card_texts.text as text',
            'classes.name as class',
        ])
        ->with(['cardMechanics' => function($q){
            $q->select('id', 'name');
        }])
        // Hero portrait is not a card.
        ->where('card_types.name', '!=', 'HERO')
        ->take(5)
        ->get();
});

Route::get('sitemap.xml', 'GeneralController@getSitemapXml');

/*
Route::get('test', function() {
    $url = 'http://php.net/manual/en/language.oop5.overloading.php';
    $p = new App\Classes\Page\PageTypeHelper($url);
    return var_dump($p->isValidUrl());
    $a = new App\Classes\Page\Channel('https://laravel.com/docs/5.1/testing');
    return $a->getTitle();
});
*/

/*
Route::get('', 'GeneralController@getHome');
Route::get('account/username/edit', 'AccountsController@getUsernameEdit');
Route::post('account/username/edit', 'AccountsController@postUsernameEdit');
Route::get('account/username/confirm', 'AccountsController@getConfirmUsername');

Route::get('auth/{provider}', 'AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'AuthController@handleProviderCallback');
*/

/*
Route::get('pages', 'PagesController@index');
Route::post('pages', 'PagesController@store');
Route::get('pages/{pageSlug}', 'PagesController@show');
// Route::post('pages/{page}/comment', 'PagesController@postComment');

Route::get('videos', 'VideosController@index');
Route::post('videos', 'VideosController@store');
Route::get('videos/{video}', 'VideosController@show');
*/

/*

Route::get('zohoverify/verifyforzoho.html', function()
{
    return response('1460414100837')->header('Content-Type', 'text/html');
});

Route::get('api/users/current', 'AuthController@getCurrentUser');
Route::post('api/users/login', 'AuthController@postLogin');
Route::post('api/users/create', 'AuthController@postCreateUser');
Route::get('api/users/logout', 'AuthController@getLogout');

Route::get('api/cards', 'CardsController@getCardsJson');
Route::get('api/cards/attributes', 'CardsController@getCardAttributesJson');

Route::get('api/pages', 'PagesController@getPagesJson');
Route::get('api/pages/types', 'PageTypesController@getPageTypes');
Route::post('api/pages/create/', 'PagesController@postCreate');
Route::get('api/pages/{slug}', 'PagesController@getPageJson');
Route::post('api/pages/{slug}/comment', 'PagesController@postComment');
Route::post('api/pages/{slug}/vote', 'PagesController@postVote');

Route::post('api/comments/{id}/vote', 'CommentsController@postVote');

Route::get('api/videos', 'VideosController@getVideosJson');

Route::get('api/tags', 'TagsController@getTagsJson');

Route::get('api/orderBy', 'GeneralController@getOrderByJson');

*/
/**
 * Next routes are for development purposes only
 */
// Route::get('ang/pages', 'PagesController@getPages');
// Route::get('ang/videos', 'VideosController@getVideos');
Route::get('{any?}', function () {
    if (env('APP_ENV') == 'local')
        return view('dev');
    return view('index');
})->where('any', '(.*)');
