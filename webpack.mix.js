const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

mix.scripts([
    'resources/js/jquery.js',
    'resources/js/materialize.js',
    'resources/js/particles.js',
    'resources/js/home.js'
], 'public/js/all.js');

mix.styles([
    'resources/sass/materialize.scss',
    'resources/sass/home.scss',
    'resources/sass/material-icons.scss'
], 'public/css/all.css');
