
module.exports = {
    publicPath: 'https://d15lhc6p38kxp4.cloudfront.net/2a5c99f3-38fa-4ef6-9d08-f0a3c0bd1208/vendor/musora-center/dist/' ,
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
