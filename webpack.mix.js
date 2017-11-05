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

mix
// themes assset js

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
    .js([
        'resources/assets/js/penyakit/laporan/index.js',
        'resources/assets/js/penyakit/laporan/create.js',
    ], 'public/js/penyakit/laporan.js')
    .js([
        'resources/assets/js/penyakit/laporan/detail.js',
    ], 'public/js/penyakit/detail.js')
    .js([
        'resources/assets/js/penyakit/profile/index.js',
        'resources/assets/js/penyakit/profile/create.js',
    ], 'public/js/penyakit/profile.js')
    .js([
        'resources/assets/js/setting/penyakit/index.js',
    ], 'public/js/setting/penyakit.js')
    .js([
        'resources/assets/js/setting/tindakan/index.js',
    ], 'public/js/setting/tindakan.js')
    .js([
        'resources/assets/js/setting/status/index.js',
    ], 'public/js/setting/status.js')

    .js([
        'resources/assets/js/master/dinkes/index.js',
        'resources/assets/js/master/dinkes/create.js'
    ], 'public/js/master/dinkes.js')

    .js([
        'resources/assets/js/master/puskesmas/index.js',
        'resources/assets/js/master/puskesmas/create.js'
    ], 'public/js/master/puskesmas.js')

    .js([
        'resources/assets/js/master/rumah_sakit/index.js',
        'resources/assets/js/master/rumah_sakit/create.js'
    ], 'public/js/master/rumah_sakit.js')

    .js([
        'resources/assets/js/master/petugas/index.js',
        'resources/assets/js/master/petugas/create.js'
    ], 'public/js/master/petugas.js')


    .js([
        'resources/assets/js/notification/setup/index.js',
        'resources/assets/js/notification/setup/create.js',
        'resources/assets/js/notification/setup/show.js'
    ], 'public/js/notification/setup.js')


    .js([
        'resources/assets/js/notification/history/index.js',
    ], 'public/js/notification/history.js')

    .sass('resources/assets/sass/app.scss', 'public/css');
