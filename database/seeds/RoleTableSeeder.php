<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role')->insert([
            ['name' => 'super_admin'], // 1
            ['name' => 'admin'], // 2
            ['name' => 'manager'], // 3
            ['name' => 'mobile'], // 4
        ]);
    }
}
