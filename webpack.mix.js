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

mix.js('resources/js/app.js','public/js')
    .autoload({
        jquery:['$','jquery','jQuery','window.jquery'],
        "popper.js":["Popper"]
    })
    .extract()
    .js('resources/js/admin.js','public/js')
    .js('resources/js/home.js','public/js')
    .copyDirectory('resources/template/home/images','public/images')
    .sass('resources/sass/admin.scss','public/css')
    .sass('resources/sass/home.scss','public/css')
    .sass('resources/sass/app.scss', 'public/css').js('node_modules/popper.js/dist/popper.js', 'public/js').sourceMaps();
