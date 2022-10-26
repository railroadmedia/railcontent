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
mix.setPublicPath('./public/');
mix
    .js('resources/marketing/assets/js/app.js', 'public/marketing/js')
    .vue({ version: 3 })
    .sass('resources/marketing/assets/css/app.scss', 'public/marketing/css')
    .options({
        postCss: [tailwindcss('./resources/marketing/marketing.tailwind.config.js')],
    })
    .extract()
    .sourceMaps()
    .version()
    .mergeManifest();

if (mix.inProduction()) {
    const ASSET_URL = process.env.ASSET_URL + "/";

    mix.webpackConfig(webpack => {
        return {
            plugins: [
                new webpack.DefinePlugin({
                    "process.env.ASSET_PATH": JSON.stringify(ASSET_URL)
                })
            ],
            output: {
                publicPath: ASSET_URL
            }
        };
    });
}
