var elixir = require('laravel-elixir');

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

elixir(function(mix) {
    mix.sass('app.scss', 'resources/css');

    mix.styles([
        'libs/bootstrap.min.css',
        'libs/sweetalert.css',
        'libs/dropzone.min.css',
    ], 'public/css/all.css', 'resources/css');

    mix.scripts([
        'libs/sweetalert.min.js',
        'libs/vue-resource.min.js',
        'libs/vue.min.js',
        'libs/jquery-2.1.4.min.js',
        'libs/bootstrap.min.js',
        'libs/dropzone.min.js',
    ], 'public/js/all.js', 'resources/js');

    mix.version(['css/all.css', 'js/all.js']);
});
