<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePuskesmas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puskesmas', function (Blueprint $table) {
            $table->increments('id');
            $table->text('nama');
            $table->longText('alamat');
            $table->integer('kelurahan')->unsigned();
            $table->integer('kecamatan')->unsigned();
            $table->integer('pic')->unsigned();
            $table->integer('created_by')->unsigned();
            $table->timestamps();

//            $table->foreign('kelurahan')->references('kelurahan_id')->on('kelurahan')->onDelete('cascade');
//            $table->foreign('kecamatan')->references('kecamatan_id')->on('kecamatan')->onDelete('cascade');
//            $table->foreign('pic')->references('id')->on('users')->onDelete('cascade');
//            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('puskesmas');
    }
}
