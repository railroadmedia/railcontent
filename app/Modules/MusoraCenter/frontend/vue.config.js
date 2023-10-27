const ASSET_URL = process.env.VUE_APP_ASSET_BASE || '/';

module.exports = {
    publicPath: ASSET_URL + 'vendor/musora-center/dist/' ,
    outputDir: process.env.NODE_ENV === 'production'
        ? '../public/dist/'
        : '../public/dist/js',
    productionSourceMap: false,
    filenameHashing: false,
    css: {
        extract: false,
    },
    chainWebpack: config => {
        config.plugins.delete('html');
        config.plugins.delete('preload');
        config.plugins.delete('prefetch');
        config.plugins.delete('hmr');
        config.optimization.delete('splitChunks');
    }
};
