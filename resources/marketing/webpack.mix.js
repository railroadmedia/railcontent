const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');
require('laravel-mix-merge-manifest');
const ASSET_URL =
  process.env.NODE_ENV === "production" ? (process.env.ASSET_URL || '' ) + "/" : "/";

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
    .vue({ version: 3 })
    .sass('resources/marketing/assets/css/app.scss', 'public/marketing/css')
    .options({
        postCss: [tailwindcss('./resources/marketing/marketing.tailwind.config.js')],
    })
    .version()
    .mergeManifest()
    .dump();

mix.webpackConfig(webpack => {
    return {
        // target: ['web', 'es5'],
        output: {
            publicPath: ASSET_URL,
        },
        plugins: [
            new webpack.DefinePlugin({
                "process.env.ASSET_PATH": JSON.stringify(ASSET_URL)
            })
        ]
    };
});