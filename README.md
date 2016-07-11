# demo_blog
This is a demo project. In developing this project use Laravel 5.2.

### Laravel PHP Framework

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, queueing, and caching.

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

## Installation ##

* `git clone https://github.com/dejanr77/demo_blog.git`
* `cd demo_blog`
*  Create a database and inform *.env* (create this file as .env.example)
* `composer install`
* `php artisan key:generate`
* `php artisan migrate --seed` to create and populate tables
*  Inform *config/mail.php* for email sends
* `php artisan vendor:publish`

## License ##

MIT: [http://anthony.mit-license.org](http://anthony.mit-license.org)
