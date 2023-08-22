const path = require('path')

module.exports = {
    entry: './resources/marketing/assets/react/index.js',
    output: {
        filename: 'bundle.js',
        path: path.resolve(__dirname) + '/../../public/marketing/react',
        publicPath: './public/marketing/react/',
    },
    // ...add the babel-loader and preset
    module: {
        rules: [
            {
                test: /\.(js|jsx)$/,
                exclude: /node_modules/,
                use: ['babel-loader'],
            },
        ],
    },
    // ...add resolve to .jsx extension
    resolve: {
        extensions: ['*', '.js', '.jsx'],
    },
    // ...
}
