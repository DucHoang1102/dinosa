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

// For libs
mix.scripts([
        'node_modules/jquery/dist/jquery.min.js',
        'node_modules/bootstrap/dist/js/bootstrap.min.js'
    ], 'public/js/lib.min.js')
   .styles('node_modules/bootstrap/dist/css/bootstrap.css', 'public/css/bootstrap.css')
   .copyDirectory('node_modules/bootstrap/fonts', 'public/fonts');

// For assets
mix.js('resources/js/main.js', 'public/js')
   .sass('resources/sass/style.scss', 'public/css')
   .copyDirectory('resources/img', 'public/img');

if (mix.inProduction()) {
    mix.version();
}