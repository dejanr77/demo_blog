<?php

Route::post('comment',[
    'uses' => 'CommentsController@store',
    'as' => 'comment.store'
]);

