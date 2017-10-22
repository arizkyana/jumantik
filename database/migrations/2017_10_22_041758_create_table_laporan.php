<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLaporan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('tgl_close')->nullable();
            $table->integer('pelapor');
            $table->boolean('is_suspect_dbd');
            $table->integer('jumlah_suspect_dbd');
            $table->text('penyakit');
            $table->longText('keterangan')->nullable();
            $table->boolean('is_fogging');
            $table->integer('kecamatan');
            $table->integer('kelurahan');
            $table->float('lat');
            $table->float('lon');
            $table->integer('status');
            $table->boolean('is_pekdrs');
            $table->integer('update_by');


            $table->foreign('pelapor')->references('id')->on('users')->onDeleted('cascade');
            $table->foreign('update_by')->references('id')->on('users')->onDeleted('cascade');
//            $table->foreign('role_id')->references('id')->on('role')->onDelete('cascade');
//            $table->foreign('menu_id')->references('id')->on('menu')->onDelete('cascade');

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
        Schema::drop('laporan');
    }
}
