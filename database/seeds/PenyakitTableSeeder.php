<?php

use Illuminate\Database\Seeder;


class PenyakitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('penyakit')->insert([
            [
                'nama' => 'Malaria',
                'is_visible' => TRUE
            ],
            [
                'name' => 'Demam Berdarah',
                'is_visible' => TRUE
            ],
            [
                'name' => 'Cikungunya',
                'is_visible' => TRUE
            ]
        ]);
    }
}
