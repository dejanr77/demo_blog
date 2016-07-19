<?php
namespace App\LaravelFilemanager\controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

/**
 * Class DownloadController
 * @package Unisharp\Laravelfilemanager\controllers
 */
class DownloadController extends LfmController {

    /**
     * Download a file
     *
     * @return mixed
     */
    public function getDownload()
    {
        return Response::download(parent::getPath('directory') . Input::get('file'));
    }

}
