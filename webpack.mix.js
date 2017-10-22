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
        'resources/assets/js/apiClient/create.js',
        'resources/assets/js/apiClient/edit.js',
        'resources/assets/js/apiClient/index.js',
    ], 'public/js/apiClient.js')
    .js([
        'resources/assets/js/menu/index.js'
    ], 'public/js/menu.js')
    .js([
        'resources/assets/js/role/index.js'
    ], 'public/js/role.js')
    .js([
        'resources/assets/js/dashboard/index.js'
    ], 'public/js/dashboard.js')
    .js([
        'resources/assets/js/laporan/index.js',
    ], 'public/js/laporan.js')
    .js([
        'resources/assets/js/puskesmas/laporan/index.js',
    ], 'public/js/puskesmas/laporan.js')
    .js([
        'resources/assets/js/rs/laporan/index.js',
    ], 'public/js/rs/laporan.js')
    .js([
        'resources/assets/js/dinkes/laporan/index.js',
    ], 'public/js/dinkes/laporan.js')
    .js([
        'resources/assets/js/dinkes/jadwal/index.js',
    ], 'public/js/dinkes/jadwal.js')
    .js([
        'resources/assets/js/jumantik/laporan/index.js',
        'resources/assets/js/jumantik/laporan/create.js',
    ], 'public/js/jumantik/laporan.js')
   .sass('resources/assets/sass/app.scss', 'public/css');
