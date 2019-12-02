const mix = require('laravel-mix');
require('laravel-mix-bundle-analyzer');

if (!mix.inProduction()) {
    mix.bundleAnalyzer();
}
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
mix.copy('resources/assets/img/google-logo.png', 'public/img');
mix.copy('resources/assets/img/boe.webp', 'public/img');
mix.copy('resources/assets/img/lex.webp', 'public/img');
mix.copy('resources/assets/img/powered_by_stripe@3x.png', 'public/img');
mix.copy('resources/assets/img/powered_by_stripe@2x.png', 'public/img');
mix.copy('resources/assets/img/powered_by_stripe.png', 'public/img');

if (mix.inProduction()) {
    mix.version();
}

mix.browserSync('boletines.dev');
