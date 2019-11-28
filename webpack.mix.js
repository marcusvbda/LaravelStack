let mix = require('laravel-mix');
mix.webpackConfig({
    resolve: {
        modules: [
            'node_modules',
        ]
    }
});
mix.options({
    processCssUrls: true
});
mix.autoload({
    jquery: ['$', 'window.jQuery', 'jQuery', 'jquery']
});
mix.js('resources/js/backend/app.js', 'public/assets/backend/js/app.js')
    .sass('resources/sass/backend/app.scss', 'public/assets/backend/css')
    .extract([
        'jquery',
        'vue',
    ]);