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

//mix.js('resources/js/app.js', 'public/js')
//   .sass('resources/sass/app.scss', 'public/css');


mix.sass('resources/assets/sass/custom.scss','public/css')
    .js('resources/assets/js/custom.js','public/js')
    .js('resources/assets/js/fullscreen.js','public/js')
    .js('resources/assets/vuejs/activities/index.js', 'public/vuejs');
