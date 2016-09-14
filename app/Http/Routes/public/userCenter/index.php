<?php

Route::get('user/home/{user}', [
    'uses' => 'UserCentersController@show',
    'as' => 'userCenters.show'
]);

Route::get('user/articles/{user}', [
    'uses' => 'UserCentersController@articles',
    'as' => 'userCenters.articles'
]);

Route::get('user/images/{user}', [
    'uses' => 'UserCentersController@images',
    'as' => 'userCenters.images'
]);

Route::get('user/files/{user}', [
    'uses' => 'UserCentersController@files',
    'as' => 'userCenters.files'
]);

Route::get('user/notifications/{user}',[
    'uses' => 'UserCentersController@notifications',
    'as' => 'userCenters.notifications'
]);

Route::get('user/notifications/show/{notification}',[
    'uses' => 'UserCentersController@showNotification',
    'as' => 'userCenters.showNotification'
]);

Route::get('user/author',[
    'uses' => 'UserCentersController@authorRequest',
    'as' => 'userCenters.authorRequest'
]);

