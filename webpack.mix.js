const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.options({
	processCssUrls: false,
});

mix.sass('resources/sass/app.scss', 'public/css').sourceMaps();

mix.js('resources/js/app.js', 'public/js').vue();
mix.js('resources/js/admin.js', 'public/js').vue();

if (mix.inProduction()) {
    mix.version();
}

if (!mix.inProduction()) {
    mix.browserSync({
        proxy: process.env.MIX_APP_URL,
        ui: {
            port: 8080
        }
    });
}