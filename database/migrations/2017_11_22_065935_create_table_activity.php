<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableActivity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity', function (Blueprint $table) {
            $table->increments('id');
            $table->text('ip');
            $table->text('message');
            $table->integer('id_user');
            $table->boolean('is_insession')->default(true);
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
        Schema::dropIfExists('activity');
    }
}
