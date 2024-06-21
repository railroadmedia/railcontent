const mix = require('laravel-mix');
const path = require('path');

mix.setPublicPath(path.resolve(__dirname, '../../public/sanity'));

mix.js('src/index.js', '')
   .react() // if you're using React
   .webpackConfig(webpack => {
    require('dotenv').config();
    const ASSET_URL = process.env.NODE_ENV === "production" ? (process.env.ASSET_URL || '' ) + "/" : "/";
    console.log("ASSET_URL", ASSET_URL);

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
        ]
    };
})
   .version();
 