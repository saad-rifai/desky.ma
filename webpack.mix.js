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

 mix.postCss('css/style.css', 'css/min');
 mix.postCss('css/resetstyle.css', 'css/min');
 mix.postCss('css/chat/chat-style.css', 'css/min');

mix.js('resources/js/navbar.js', 'js');
mix.js('resources/js/admin.js', 'js');
mix.js('resources/js/app.js', 'js')
    .sass('resources/sass/app.scss', 'css');