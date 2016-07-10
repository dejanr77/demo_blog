<?php

Route::group([
    'namespace' => 'Frontend',
    'as' => 'public.'
], function() {
    Route::get('/',[
        'uses' => 'PagesController@home',
        'as' => 'home'
    ]);

    Route::get('about',[
        'uses' => 'PagesController@about',
        'as' => 'about'
    ]);

    Route::get('contact',[
        'uses' => 'PagesController@contact',
        'as' => 'contact'
    ]);
});



