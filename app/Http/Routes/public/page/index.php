<?php

Route::get('/',[
    'uses' => 'PagesController@home',
    'as' => 'home'
]);

Route::get('about',[
    'uses' => 'PagesController@about',
    'as' => 'about'
]);




