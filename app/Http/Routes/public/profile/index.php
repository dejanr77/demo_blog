<?php

Route::resource('profile','ProfilesController',['except' => ['index', 'destroy','show']]);

