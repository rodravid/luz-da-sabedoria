let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js([
    'resources/assets/js/jquery/jquery.js',
    'resources/assets/js/bootstrap/js/bootstrap.js',
    'resources/assets/js/html5shiv/html5shiv.js',
    'resources/assets/js/respond/respond.min.js',
    'resources/assets/js/jquery-easing/1.3/jquery.easing.min.js',
    'resources/assets/js/jqBootstrapValidation.js',
    'resources/assets/js/contact_me.js',
    'resources/assets/js/agency.min.js',
    'resources/assets/js/app.js'
], 'public/js/app.js')
    .styles([
       'public/vendor/bootstrap/css/bootstrap.min.css',
       'public/vendor/font-awesome/css/font-awesome.min.css',
       'public/css/agency.min.css',
       'resources/assets/sass/app.scss'
    ], 'public/css/app.css')
    .styles([
        'public/fonts/vendor/googleapis/droid-serif.css',
        'public/fonts/vendor/googleapis/kaushan-script.css',
        'public/fonts/vendor/googleapis/montserrat-400-700.css',
        'public/fonts/vendor/googleapis/roboto-slab.css',
    ], 'public/fonts/fonts.css');
