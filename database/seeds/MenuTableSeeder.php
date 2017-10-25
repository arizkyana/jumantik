<?php

use Illuminate\Database\Seeder;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu')->insert([
            // dashboard
            [
                'name' => 'Dashboard',
                'url' => 'dashboard',
                'icon' => 'fa fa-dashboard',
                'parent' => 0,
                'authorize_url' => 'dashboard',
                'show' => TRUE,
            ],

            // penyakit 2
            [
                'name' => 'Penyakit',
                'url' => 'penyakit',
                'icon' => 'fa fa-file',
                'parent' => 0,
                'authorize_url' => 'penyakit',
                'show' => TRUE
            ],
            [
                'name' => 'Laporan',
                'url' => 'penyakit/laporan',
                'icon' => 'fa fa-file',
                'parent' => 2,
                'authorize_url' => 'penyakit-laporan',
                'show' => TRUE
            ],
            [
                'name' => 'Profile',
                'url' => 'penyakit/Profile',
                'icon' => 'fa fa-file',
                'parent' => 2,
                'authorize_url' => 'penyakit-profile',
                'show' => TRUE
            ],

            // notification center 5
            [
                'name' => 'Notification',
                'url' => 'notification',
                'icon' => 'fa fa-notification',
                'parent' => 0,
                'authorize_url' => 'notification',
                'show' => TRUE
            ],
            [
                'name' => 'Setup',
                'url' => 'notification/setup',
                'icon' => 'fa fa-file',
                'parent' => 5,
                'authorize_url' => 'notification-setup',
                'show' => TRUE
            ],
            [
                'name' => 'History',
                'url' => 'notification/history',
                'icon' => 'fa fa-file',
                'parent' => 5,
                'authorize_url' => 'notification-history',
                'show' => TRUE
            ],

            // menu 8
            [
                'name' => 'Setting',
                'url' => 'setting',
                'icon' => 'fa fa-gear',
                'parent' => 0,
                'authorize_url' => 'setting',
                'show' => TRUE,
            ],
            [
                'name' => 'Menu',
                'url' => 'setting/menu',
                'icon' => 'fa fa-plus',
                'parent' => 8,
                'authorize_url' => 'setting-menu',
                'show' => TRUE
            ],

            // role

            [
                'name' => 'Role',
                'url' => 'setting/role',
                'icon' => 'fa fa-circle',
                'parent' => 8,
                'authorize_url' => 'setting/role',
                'show' => TRUE
            ],


            // users
            [
                'name' => 'Users',
                'url' => 'setting/users',
                'icon' => 'fa fa-user',
                'parent' => 8,
                'authorize_url' => 'setting/users',
                'show' => TRUE
            ],

        ]);
    }
}
