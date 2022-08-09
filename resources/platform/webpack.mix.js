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
    .js('resources/platform/assets/js/app.js', 'public/platform/js')
    //JS From Existing Platforms
    .js('resources/platform/assets/js/profile.js','public/platform/js')
    .js('resources/platform/assets/js/lesson-page.js','public/platform/js')
    .js('resources/platform/assets/js/learning-path-preview.js','public/platform/js')
    .vue({ version: 3 })
    .sass('resources/platform/assets/css/app.scss', 'public/platform/css')
    .options({
        postCss: [ tailwindcss('./resources/platform/tailwind.config.js') ],
    })
    .extract(['alpinejs','fast-glob'], 'vendor~unused.js')
    .extract(['shaka-player', 'screenful'], 'vendor~player.js')
    .extract(['vue-advanced-cropper'], 'vendor~onboarding.js')
    .extract()
    .sourceMaps()
    .version()
    .mergeManifest();
