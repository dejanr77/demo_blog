<?php

Route::group([
    'namespace' => 'Frontend',
    'as' => 'public.'
], function() {

    require (__DIR__ . '/page/index.php');

    require (__DIR__ . '/article/index.php');

    require (__DIR__ . '/tag/index.php');

    Route::group([
        'middleware' => 'auth'
    ],function() {

        require (__DIR__ . '/userCenter/index.php');

        require (__DIR__ . '/profile/index.php');

        require (__DIR__ . '/preview/index.php');

    });

});

