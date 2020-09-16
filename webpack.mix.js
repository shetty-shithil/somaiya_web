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

// mix.js('resources/js/app.js', 'public/js')
//     .sass('resources/sass/app.scss', 'public/css');

mix.js('resources/js/app.js', 'public/js')
.js('resources/js/_app.js', 'public/js')
.js('resources/js/abc.js', 'public/js')
.js('resources/js/event.js', 'public/js')
.js('resources/js/form.js', 'public/js')
.js('resources/js/jquery.min.js', 'public/js')
.sass('resources/sass/app.scss', 'public/css')
.sass('resources/sass/_responsive.scss', 'public/css')
.sass('resources/sass/_styles.scss', 'public/css');

