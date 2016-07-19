<?php
namespace App\LaravelFilemanager\controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Lang;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class UploadController
 * @package Unisharp\Laravelfilemanager\controllers
 */
class UploadController extends LfmController {

    private $default_file_types = ['application/pdf'];
    private $default_image_types = ['image/jpeg', 'image/png', 'image/gif'];

    /**
     * Upload an image/file and (for images) create thumbnail
     *
     * @return string
     */
    public function upload()
    {
        try {
            $res = $this->uploadValidator();
            if (true !== $res) {
                return Lang::get('laravel-filemanager::lfm.error-invalid');
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        $file = Input::file('upload');

        $new_filename = $this->getNewName($file);

        $dest_path = parent::getPath('directory');


        if ('Images' === $this->file_type)
        {
            if (File::exists($dest_path . $new_filename.'-lg.'.$file->getClientOriginalExtension()) or
                File::exists($dest_path . $new_filename.'-sm.'.$file->getClientOriginalExtension())
            ) {
                return Lang::get('laravel-filemanager::lfm.error-file-exist');
            }

            $image = Image::make($file);

            $image->resize(740, null, function ($constraint) { $constraint->aspectRatio();})
                ->save($dest_path.'/'.$new_filename.'-lg.'.$file->getClientOriginalExtension())
                ->resize(180, null, function ($constraint) { $constraint->aspectRatio();})
                ->save($dest_path.'/'.$new_filename.'-sm.'.$file->getClientOriginalExtension());

            $this->makeLgThumb($dest_path, $new_filename.'-lg.'.$file->getClientOriginalExtension());
            $this->makeSmThumb($dest_path, $new_filename.'-sm.'.$file->getClientOriginalExtension());
        }
        else
        {
            if (File::exists($dest_path . $new_filename.'.'.$file->getClientOriginalExtension())) {
                return Lang::get('laravel-filemanager::lfm.error-file-exist');
            }

            $file->move($dest_path, $new_filename.'.'.$file->getClientOriginalExtension());
        }

        // upload via ckeditor 'Upload' tab
        if (!Input::has('show_list')) {
            return $this->useFile($new_filename.$file->getClientOriginalExtension());
        }

        return 'OK';
    }

    private function uploadValidator()
    {
        // when uploading a file with the POST named "upload"

        $expected_file_type = $this->file_type;
        $is_valid = false;

        $file = Input::file('upload');
        if (empty($file)) {
            throw new \Exception(Lang::get('laravel-filemanager::lfm.error-file-empty'));
        }
        if (!$file instanceof UploadedFile) {
            throw new \Exception(Lang::get('laravel-filemanager::lfm.error-instance'));
        }
        if($file->getClientSize() > Config::get('lfm.max_file_size')*1000000)
        {
            throw new \Exception(Lang::get('laravel-filemanager::lfm.error-max-file-size').Config::get('lfm.max_file_size').'mb');
        }

        $mimetype = $file->getMimeType();

        if ($expected_file_type === 'Files') {
            $config_name = 'lfm.valid_file_mimetypes';
            $valid_mimetypes = Config::get($config_name, $this->default_file_types);
        } else {
            $config_name = 'lfm.valid_image_mimetypes';
            $valid_mimetypes = Config::get($config_name, $this->default_image_types);
        }

        if (!is_array($valid_mimetypes)) {
            throw new \Exception('Config : ' . $config_name . ' is not set correctly');
        }

        if (in_array($mimetype, $valid_mimetypes)) {
            $is_valid = true;
        }

        if (false === $is_valid) {
            throw new \Exception(Lang::get('laravel-filemanager::lfm.error-mime') . $mimetype);
        }
        return $is_valid;
    }

    private function getNewName($file)
    {
        $old_filename = $file->getClientOriginalName();

        if (Config::get('lfm.rename_file') === true)
        {
            $new_filename = uniqid();
        }
        elseif (Config::get('lfm.alphanumeric_filename') === true)
        {
            $new_filename = preg_replace('/[^A-Za-z0-9\-\']/', '_',  e(substr_replace($old_filename,"",-4)));
        }
        else
        {
            $new_filename = $old_filename;
        }

        return $new_filename;
    }

    private function makeSmThumb($dest_path, $new_filename)
    {
        $thumb_folder_name = Config::get('lfm.thumb_folder_name');

        if (!File::exists($dest_path . $thumb_folder_name)) {
            File::makeDirectory($dest_path . $thumb_folder_name);
        }

        $thumb_img = Image::make($dest_path . $new_filename);
        $thumb_img->fit(120)
            ->save($dest_path . $thumb_folder_name . '/'. $new_filename);
        unset($thumb_img);
    }

    private function makeLgThumb($dest_path, $new_filename)
    {
        $thumb_folder_name = Config::get('lfm.thumb_folder_name');

        if (!File::exists($dest_path . $thumb_folder_name)) {
            File::makeDirectory($dest_path . $thumb_folder_name);
        }

        $thumb_img = Image::make($dest_path . $new_filename);
        $thumb_img->fit(200)
            ->save($dest_path . $thumb_folder_name . '/' . $new_filename);
        unset($thumb_img);
    }

    private function useFile($new_filename)
    {
        $file = parent::getUrl() . $new_filename;

        return "<script type='text/javascript'>

        function getUrlParam(paramName) {
            var reParam = new RegExp('(?:[\?&]|&)' + paramName + '=([^&]+)', 'i');
            var match = window.location.search.match(reParam);
            return ( match && match.length > 1 ) ? match[1] : null;
        }

        var funcNum = getUrlParam('CKEditorFuncNum');

        var par = window.parent,
            op = window.opener,
            o = (par && par.CKEDITOR) ? par : ((op && op.CKEDITOR) ? op : false);

        if (op) window.close();
        if (o !== false) o.CKEDITOR.tools.callFunction(funcNum, '$file');
        </script>";
    }

}
