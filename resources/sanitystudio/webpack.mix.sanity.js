const mix = require('laravel-mix');
const path = require('path');

mix.setPublicPath(path.resolve(__dirname, '../../public/sanity'));

mix.js('src/index.js', 'bundle.js')
   .react() // if you're using React
   .extract(['react', 'react-dom', 'other-vendor-libraries']) // Add all your vendor libraries here
   .webpackConfig({
        optimization: {
            splitChunks: {
                cacheGroups: {
                    vendor: {
                        test: /[\\/]node_modules[\\/]/,
                        name: 'vendor',
                        chunks: 'all',
                    },
                },
            },
        },
        stats: {
            children: true
        },
        output: {
            filename: '[name].js', // Ensure a single output file
            chunkFilename: '[name].js', // Ensure any chunked files are merged into the same output
        },
    })
   .version();
