<?php

Route::get('notification',[
    'uses' => 'NotificationsController@index',
    'as' => 'notification.index'
]);

Route::get('notification/create',[
    'uses' => 'NotificationsController@create',
    'as' => 'notification.create'
]);

Route::post('notification',[
    'uses' => 'NotificationsController@store',
    'as' => 'notification.store'
]);

Route::get('notification/{notification}',[
    'uses' => 'NotificationsController@show',
    'as' => 'notification.show'
]);



