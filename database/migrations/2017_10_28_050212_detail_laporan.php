<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DetailLaporan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_laporan', function (Blueprint $table) {
            $table->increments('id_detail_laporan');
            $table->string('id_laporan');
            $table->longText('foto_detail_laporan')->nullable();
            $table->longText('keterangan_detail_laporan')->nullable();
            $table->integer('tindakan_detail_laporan');
            $table->integer('status_detail_laporan');
            $table->boolean('is_visible');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
