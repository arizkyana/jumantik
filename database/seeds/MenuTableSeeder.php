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
            [
                'name' => 'Sekolah',
                'url' => '#',
                'icon' => 'fa fa-building',
                'parent' => 0
            ],
            [
                'name' => 'Tambah Sekolah',
                'url' => 'sekolah/add',
                'icon' => 'fa fa-plus',
                'parent' => 1
            ]
        ]);
    }
}
