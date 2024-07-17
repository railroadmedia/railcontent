const mix = require('laravel-mix');
const path = require('path');
const tailwindcss = require('tailwindcss');
const ASSET_URL = process.env.NODE_ENV === "production" ? (process.env.ASSET_URL || '' ) + "/" : "/";

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
/*
 |--------------------------------------------------------------------------
 | Mix Asset Managemen
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/platform/assets/js/app.js', 'public/platform/js')
    //JS From Existing Platforms
    .js('resources/platform/assets/js/lesson-page.js', 'public/platform/js')
    .js('resources/platform/assets/js/books.js', 'public/platform/js')
    .vue({ version: 3 })
    .sass(
        'resources/platform/assets/css/app.scss',
        'public/platform/css',
        {},
        [tailwindcss('./resources/platform/tailwind.config.js')]
    )
    .sass(
        'resources/marketing/assets/sass/app.scss',
        'public/marketing/css',
        {},
        [tailwindcss('./resources/marketing/marketing.tailwind.config.js')]
    )
    .sass(
        'resources/marketing/assets/sass/vuesora.scss',
        'public/marketing/css',
        {},
        [tailwindcss('./resources/marketing/marketing.tailwind.config.js')]
    )
    .options({
        processCssUrls: false,
    })
    .extract(['alpinejs', 'fast-glob'], 'vendor~unused.js')
    .extract(['shaka-player', 'screenful', 'mux.js', 'mediaelement', 'mediaelement-plugins'], 'vendor~player.js')
    .extract()
    .sourceMaps()
    .version();

    mix.webpackConfig(webpack => {
        return {
            stats: {
                children: true
            },
            // target: ['web', 'es5'],
            output: {
                publicPath: ASSET_URL,
            },
            plugins: [
                new webpack.DefinePlugin({
                    "process.env.ASSET_PATH": JSON.stringify(ASSET_URL)
                })
            ],
            resolve: {
                alias: {
                    '@components': path.resolve(__dirname, './assets/js/Components'),
                    '@stores': path.resolve(__dirname, './assets/js/Stores'),
                    '@constants': path.resolve(__dirname, './assets/js/Constants'),
                    '@services': path.resolve(__dirname, './assets/js/Services'),
                    '@hooks': path.resolve(__dirname, './assets/js/Hooks'),
                    //Components
                    '@units': path.resolve(__dirname, './assets/js/Components/_Units'),
                    '@collections': path.resolve(__dirname, './assets/js/Components/_Collections'),
                    '@pages': path.resolve(__dirname, './assets/js/Components/_Pages'),
                    //Libraries
                    '@vuesora': path.resolve(__dirname, './assets/js/Libraries/Vuesora'),
                }
            }
        };
    });
    

module.exports = mix;
