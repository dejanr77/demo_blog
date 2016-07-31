<?php

Route::resource('article', 'ArticlesController');

Route::get('article/user/{name}',[
    'uses' => 'ArticlesController@user',
    'as' => 'article.user'
]);