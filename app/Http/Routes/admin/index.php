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
});
