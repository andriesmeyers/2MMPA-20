<?php

Route::group([
    'middleware' => [
        'cors',
    ],
    'namespace' => 'Api',
    'prefix' => 'api/v1',
], function () {
    $options = [
        'except' => [
            'create',
            'edit',
        ]
    ];
    Route::resource('categories', 'CategoriesController', $options);
    Route::resource('products', 'ProductController', $options);
});