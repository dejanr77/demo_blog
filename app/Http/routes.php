<?php

Route::group([
    'namespace' => 'Frontend',
    'as' => 'public.'
], function() {
    Route::get('/',[
        'uses' => 'PagesController@home',
        'as' => 'home'
    ]);

    Route::resource('articles', 'ArticlesController');
    Route::get('articles/user/{name}',[
        'uses' => 'ArticlesController@user',
        'as' => 'articles.user'
    ]);

    Route::get('about',[
        'uses' => 'PagesController@about',
        'as' => 'about'
    ]);

    Route::get('contact',[
        'uses' => 'PagesController@contact',
        'as' => 'contact'
    ]);
});


Route::auth();

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


