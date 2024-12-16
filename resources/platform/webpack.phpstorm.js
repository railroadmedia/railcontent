const path = require('path')
const webpack = require('webpack')

module.exports = {
    resolve: {
        extensions: ['.js', '.json', '.vue'],
        alias: {
            '@components': path.resolve(__dirname, './assets/js/Components'),
            '@libraries': path.resolve(__dirname, './assets/js/Libraries'),
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
    },
}
