<?php

Route::group([
    'middleware' => 'auth',
    'prefix' => 'admin',
    'namespace' => 'Backend',
    'as' => 'admin.'
], function(){
    Route::get('/',[
        'uses' => 'DashboardController@index',
        'as' => 'dashboard'
    ]);
});
