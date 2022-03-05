const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');
require('laravel-mix-merge-manifest');

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

mix
    .js('resources/marketing/assets/js/app.js', 'public/marketing/js')
    .vue()
    .postCss('resources/marketing/assets/css/app.css', 'public/marketing/css', [
        require('tailwindcss')
    ])
    .options({
        postCss: [ tailwindcss('./resources/marketing/marketing.tailwind.config.js')],
    })
    .version()
    .mergeManifest();