<?php

use Illuminate\Database\Seeder;

class RoleMenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_menu')->insert([
            ['role_id' => 1,
                'menu_id' => 1],
            ['role_id' => 1,
                'menu_id' => 2]
        ]);
    }
}
