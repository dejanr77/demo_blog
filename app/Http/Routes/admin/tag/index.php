<?php

Route::get('article/tag',[
    'uses' => 'TagsController@index',
    'as' => 'article.tag.index'
]);

Route::get('article/tag/create',[
    'uses' => 'TagsController@create',
    'as' => 'article.tag.create'
]);

Route::post('article/tag',[
    'uses' => 'TagsController@store',
    'as' => 'article.tag.store'
]);

Route::get('article/tag/{tag}/edit',[
    'uses' => 'TagsController@edit',
    'as' => 'article.tag.edit'
]);

Route::patch('article/tag/{tag}',[
    'uses' => 'TagsController@update',
    'as' => 'article.tag.update'
]);

Route::get('article/tag/{tag}/delete',[
    'uses' => 'TagsController@delete',
    'as' => 'article.tag.delete'
]);


