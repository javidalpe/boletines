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

mix.sass('resources/assets/sass/app.scss', 'public/css');
mix.sass('resources/assets/sass/search.scss', 'public/css');
mix.react('resources/assets/js/search/search.jsx', 'public/js');
mix.copy('node_modules/jquery/dist/jquery.slim.min.js', 'public/js');

if (mix.inProduction()) {
    mix.version();
}

mix.browserSync('boletines.dev');
