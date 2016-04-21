<?php

Route::group([
    'middleware' => [
        'web',
    ],
], function () {
    Route::auth();
    Route::get('/home', 'HomeController@index');
    Route::group([
        'namespace' => 'Shop',
        'prefix' => 'shop'
    ], function () {
        Route::resource('products', 'ProductController');
    });
});