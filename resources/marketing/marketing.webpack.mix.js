const mix = require('laravel-mix');

mix.setPublicPath('public/frontend')
    .setResourceRoot('/frontend')

mix.js('resources/frontend/js/app.js', 'public/frontend/js')
    .sass('resources/frontend/sass/app.scss', 'public/frontend/css')