<?php

Route::get('tags',[
    'uses' => 'TagsController@index',
    'as' => 'tags.index'
]);

Route::get('tags/articles/{slug}',[
    'uses' => 'TagsController@articles',
    'as' => 'tags.articles'
]);
