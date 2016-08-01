<?php

Route::get('previews/{previews}',[
    'uses' => 'PreviewsController@show',
    'as' => 'previews.show'
]);

Route::patch('previews/{previews}',[
    'uses' => 'PreviewsController@update',
    'as' => 'previews.update'
]);

Route::get('previews/{previews}/edit',[
    'uses' => 'PreviewsController@edit',
    'as' => 'previews.edit'
]);

Route::get('previews/{previews}/delete',[
    'uses' => 'PreviewsController@delete',
    'as' => 'previews.delete'
]);


