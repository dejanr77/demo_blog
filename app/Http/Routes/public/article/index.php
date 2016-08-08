<?php

Route::resource('article', 'ArticlesController');

Route::get('article/user/{name}',[
    'uses' => 'ArticlesController@user',
    'as' => 'article.user'
]);

Route::get('article/{article}/status',[
    'uses' => 'ArticlesController@status',
    'as' => 'article.status'
]);

Route::get('article/{article}/comments',[
    'uses' => 'ArticlesController@comments',
    'as' => 'article.comments'
]);

Route::get('article/{article}/like',[
    'uses' => 'ArticlesController@like',
    'as' => 'article.like'
]);

Route::get('article/{article}/dislike',[
    'uses' => 'ArticlesController@dislike',
    'as' => 'article.dislike'
]);

