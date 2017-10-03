<?php

use Illuminate\Database\Seeder;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'developer',
                'email' => 'dev@edu.id',
                'password' => bcrypt(12341234),
                'role_id' => 1
            ],
            [
                'name' => 'admin',
                'email' => 'admin@edu.id',
                'password' => bcrypt(12341234),
                'role_id' => 2
            ],
            [
                'name' => 'manager',
                'email' => 'manager@edu.id',
                'password' => bcrypt(12341234),
                'role_id' => 3
            ]
        ]);
    }
}
