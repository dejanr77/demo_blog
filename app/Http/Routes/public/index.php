<?php

Route::group([
    'namespace' => 'Frontend',
    'as' => 'public.'
], function() {

    require (__DIR__ . '/page/index.php');

    require (__DIR__ . '/article/index.php');

    require (__DIR__ . '/tag/index.php');




});

