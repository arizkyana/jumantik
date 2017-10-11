let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
    .js([
        'resources/assets/js/users/create.js',
        'resources/assets/js/users/edit.js',
        'resources/assets/js/users/index.js',
    ], 'public/js/users.js')
    .js([
        'resources/assets/js/menu/index.js'
    ], 'public/js/menu.js')
    .js([
        'resources/assets/js/role/index.js'
    ], 'public/js/role.js')
    .js([
        'resources/assets/js/dashboard/index.js'
    ], 'public/js/dashboard.js')
   .sass('resources/assets/sass/app.scss', 'public/css');
