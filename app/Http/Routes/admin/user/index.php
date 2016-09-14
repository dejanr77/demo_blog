<?php

Route::get('user',[
    'uses' => 'UsersController@index',
    'as' => 'user.index'
]);

Route::get('user/roles',[
    'uses' => 'UsersController@roles',
    'as' => 'user.roles'
]);

Route::get('user/roles/{role}/edit',[
    'uses' => 'UsersController@editRole',
    'as' => 'user.editRole'
]);

Route::patch('user/roles/{role}',[
    'uses' => 'UsersController@updateRole',
    'as' => 'user.updateRole'
]);

Route::get('user/{user}',[
    'uses' => 'UsersController@show',
    'as' => 'user.show'
]);

Route::patch('user/{user}',[
    'uses' => 'UsersController@update',
    'as' => 'user.update'
]);




