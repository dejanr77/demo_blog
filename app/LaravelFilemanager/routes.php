<?php
$middlewares = \Config::get('lfm.middlewares');
array_push($middlewares, '\App\LaravelFilemanager\middleware\MultiUser');

// make sure authenticated
Route::group(array('middleware' => $middlewares, 'prefix' => 'laravel-filemanager'), function ()
{
    // Show LFM
    Route::get('/', '\App\LaravelFilemanager\controllers\LfmController@show');

    // upload
    Route::any('/upload', '\App\LaravelFilemanager\controllers\UploadController@upload');

    // list images & files
    Route::get('/jsonitems', '\App\LaravelFilemanager\controllers\ItemsController@getItems');

    // folders
    Route::get('/newfolder', '\App\LaravelFilemanager\controllers\FolderController@getAddfolder');
    Route::get('/deletefolder', '\App\LaravelFilemanager\controllers\FolderController@getDeletefolder');
    Route::get('/folders', '\App\LaravelFilemanager\controllers\FolderController@getFolders');



    // rename
    Route::get('/rename', '\App\LaravelFilemanager\controllers\RenameController@getRename');



    // download
    Route::get('/download', '\App\LaravelFilemanager\controllers\DownloadController@getDownload');

    // delete
    Route::get('/delete', '\App\LaravelFilemanager\controllers\DeleteController@getDelete');
});
