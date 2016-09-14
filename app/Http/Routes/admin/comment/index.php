<?php

Route::get('comment',[
    'uses' => 'CommentsController@index',
    'as' => 'comment.index'
]);

Route::get('comment/trash',[
    'uses' => 'CommentsController@trash',
    'as' => 'comment.trash'
]);

Route::get('comment/{comment}/delete',[
    'uses' => 'CommentsController@delete',
    'as' => 'comment.delete'
]);

Route::get('comment/{comment}/restore',[
    'uses' => 'CommentsController@restore',
    'as' => 'comment.restore'
]);

Route::get('comment/{comment}',[
    'uses' => 'CommentsController@show',
    'as' => 'comment.show'
]);

