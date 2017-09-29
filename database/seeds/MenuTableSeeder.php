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
            // menu
            [
                'name' => 'Menu',
                'url' => '#',
                'icon' => 'fa fa-building',
                'parent' => 0,
                'authorize_url' => '#',
                'show' => TRUE,
            ],
            [
                'name' => 'Daftar Menu',
                'url' => 'menu',
                'icon' => 'fa fa-plus',
                'parent' => 2,
                'authorize_url' => 'menu',
                'show' => TRUE
            ],
            [
                'name' => 'Tambah Menu',
                'url' => 'menu/create',
                'icon' => 'fa fa-plus',
                'parent' => 2,
                'authorize_url' => 'menu-create',
                'show' => TRUE
            ],

            // role
            [
                'name' => 'Role',
                'url' => '#',
                'icon' => 'fa fa-user',
                'parent' => 0,
                'authorize_url' => '#',
                'show' => TRUE
            ],
            [
                'name' => 'Daftar Role',
                'url' => 'role',
                'icon' => 'fa fa-circle',
                'parent' => 5,
                'authorize_url' => 'role',
                'show' => TRUE
            ],
            [
                'name' => 'Tambah Role',
                'url' => 'role/create',
                'icon' => 'fa fa-plus',
                'parent' => 5,
                'authorize_url' => 'role-create',
                'show' => TRUE
            ]
        ]);
    }
}
