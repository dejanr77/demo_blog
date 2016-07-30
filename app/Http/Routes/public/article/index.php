<?php

Route::resource('articles', 'ArticlesController');

Route::get('articles/user/{name}',[
    'uses' => 'ArticlesController@user',
    'as' => 'articles.user'
]);