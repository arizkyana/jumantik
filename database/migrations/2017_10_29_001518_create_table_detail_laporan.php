<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDetailLaporan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_laporan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_laporan')->unsigned();
            $table->integer('pelapor')->unsigned();
            $table->longText('foto')->nullable();
            $table->longText('keterangan');
            $table->integer('tindakan')->unsigned();
            $table->integer('status')->unsigned();
            $table->boolean('is_visible');
            $table->timestamps();

            $table->foreign('id_laporan')->references('id')->on('laporan')->onDelete('cascade');
            $table->foreign('pelapor')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('tindakan')->references('id')->on('tindakan')->onDelete('cascade');
            $table->foreign('status')->references('id')->on('status')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_laporan');
    }
}
