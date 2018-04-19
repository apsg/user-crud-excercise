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

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', '../resources/assets/css_output');

mix.styles([
   		'resources/assets/css_output/app.css',
   		'node_modules/datatables.net-dt/css/jquery.dataTables.css'
   	], 'public/css/app.css')
   .copy('node_modules/datatables.net-dt/images', 'public/images');
