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

Route::get('article/{article}/delete',[
    'uses' => 'ArticlesController@delete',
    'as' => 'article.delete'
]);

