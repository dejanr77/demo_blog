<?php

Route::group([
    'middleware' => [
        'auth',
        'acl:admin.access'
    ],
    'prefix' => 'admin',
    'namespace' => 'Backend',
    'as' => 'admin.'
], function(){
    Route::get('/',[
        'uses' => 'DashboardController@index',
        'as' => 'dashboard.index'
    ]);

    require (__DIR__ . '/tag/index.php');

    require (__DIR__ . '/article/index.php');

    require (__DIR__ . '/notification/index.php');

    require (__DIR__ . '/user/index.php');

    require (__DIR__ . '/comment/index.php');
});
