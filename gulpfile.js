var gulp = require('gulp'),
    elixir = require('laravel-elixir'),
    paths = {
        'jquery': 'node_modules/jquery/dist/',
        'bootstrap': 'node_modules/bootstrap-sass/assets/',
        'font_awesome': 'node_modules/font-awesome/',
        'bootststrap-sass': 'node_modules/assets/'
    };
/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir.config.sourcemaps = false;

elixir(function(mix) {

    mix.copy(paths.bootstrap + 'fonts/bootstrap/**', 'public/build/fonts/bootstrap');
    mix.copy(paths.font_awesome + 'fonts/**', 'public/build/fonts');

    mix.copy(paths.font_awesome + 'css/font-awesome.css', 'resources/assets/css/font-awesome.css');

    mix.copy('assets/js/article.js','public/js/article.js');

    mix.copy(paths.jquery + 'jquery.js', 'resources/assets/js/jquery.js');
    mix.copy(paths.bootstrap + 'javascripts/bootstrap.js', 'resources/assets/js/bootstrap.js');


    mix.sass('app.scss','resources/assets/css');


    mix.styles([
        '../../' + 'assets/css/app.css',
        '../../' + 'assets/css/font-awesome.css',
        '../../' + 'assets/css/clean-blog.css',
        '../../' + 'assets/css/style.css'
    ], 'public/css/demo_blog.css');


    mix.scripts([
        '../../' + 'assets/js/jquery.js',
        '../../' + 'assets/js/bootstrap.js',
        '../../' + 'assets/js/clean-blog.js'
    ], 'public/js/demo_blog.js');


    mix.version([
        'public/css/demo_blog.css',
        'public/js/demo_blog.js'
    ]);
});
