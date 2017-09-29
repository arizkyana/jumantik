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
                'authorize_url' => null,
            ],
            // menu
            [
                'name' => 'Menu',
                'url' => '#',
                'icon' => 'fa fa-building',
                'parent' => 0,
                'authorize_url' => null,
            ],
            [
                'name' => 'Daftar Menu',
                'url' => 'menu',
                'icon' => 'fa fa-plus',
                'parent' => 2,
                'authorize_url' => 'menu'
            ],
            [
                'name' => 'Tambah Menu',
                'url' => 'menu/create',
                'icon' => 'fa fa-plus',
                'parent' => 2,
                'authorize_url' => 'menu-create'
            ],

            // role
            [
                'name' => 'Role',
                'url' => '#',
                'icon' => 'fa fa-user',
                'parent' => 0,
                'authorize_url' => null
            ],
            [
                'name' => 'Daftar Role',
                'url' => 'role',
                'icon' => 'fa fa-circle',
                'parent' => 5,
                'authorize_url' => 'role'
            ],
            [
                'name' => 'Tambah Role',
                'url' => 'role/create',
                'icon' => 'fa fa-plus',
                'parent' => 5,
                'authorize_url' => 'role-create'
            ]
        ]);
    }
}
