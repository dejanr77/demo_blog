#Laravel Filemanager
This local package was developed on the basis of the package 'UniSharp/laravel-filemanager'.

## Requirements

 * php >= 5.5
 * Laravel 5
 * requires [intervention/image](https://github.com/Intervention/image)

##Installation

1. Copy to your app dir.
2. Edit config/app :
    add Service providers
    ```php
        Unisharp\Laravelfilemanager\LaravelFilemanagerServiceProvider::class,
        Intervention\Image\ImageServiceProvider::class,
    ```
    and add class aliases

    ```php
        'Image' => Intervention\Image\Facades\Image::class,
    ```
3. `php artisan vendor:publish`
4. Ensure that the files & images directories (in `config/lfm.php`) are writable by your web server.

## License ##

MIT

