<?php

Route::get('article',[
    'uses' => 'ArticlesController@index',
    'as' => 'article.index'
]);

Route::get('article/trash',[
    'uses' => 'ArticlesController@trash',
    'as' => 'article.trash'
]);

Route::get('article/{article}',[
    'uses' => 'ArticlesController@show',
    'as' => 'article.show'
]);

Route::patch('article/{article}',[
    'uses' => 'ArticlesController@update',
    'as' => 'article.update'
]);

Route::get('article/{article}/edit',[
    'uses' => 'ArticlesController@edit',
    'as' => 'article.edit'
]);

Route::get('article/{article}/preview',[
    'uses' => 'ArticlesController@preview',
    'as' => 'article.preview'
]);

Route::get('article/{article}/delete',[
    'uses' => 'ArticlesController@delete',
    'as' => 'article.delete'
]);

Route::get('article/{article}/restore',[
    'uses' => 'ArticlesController@restore',
    'as' => 'article.restore'
]);

Route::get('article/{article}/editPublishingForm',[
    'uses' => 'ArticlesController@editPublishingForm',
    'as' => 'article.editPublishingForm'
]);

Route::patch('article/{article}/publish',[
    'uses' => 'ArticlesController@publish',
    'as' => 'article.publish'
]);


