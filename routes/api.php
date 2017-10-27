<?php

Route::group(['prefix' => 'v2', 'middleware' => 'api'], function () {
    Route::group(['prefix' => 'cards'], function () {
        Route::get('/', 'CardsController2@getCardsJson');
        Route::get('attributes', 'CardsController2@getCardAttributesJson');
    });
});
