<?php

Route::post('comment',[
    'uses' => 'CommentsController@store',
    'as' => 'comment.store'
]);

Route::get('comment/{comment}/like',[
    'uses' => 'CommentsController@like',
    'as' => 'comment.like'
]);

Route::get('comment/{comment}/dislike',[
    'uses' => 'CommentsController@dislike',
    'as' => 'comment.dislike'
]);


