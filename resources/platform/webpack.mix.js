const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/platform/assets/js/app.js', 'public/platform/js')
    .vue()
    .postCss('resources/platform/assets/css/app.css', 'public/platform/css', [
        require("tailwindcss"),
    ]);
