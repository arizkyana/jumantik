<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableJadwal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal', function (Blueprint $table) {
            $table->increments('id');
            $table->date('mulai');
            $table->date('akhir')->nullable();
            $table->time('jam_mulai');
            $table->time('jam_akhir');
            $table->integer('pic'); // 1 - Sent , 2 - Done, 3 - Failed
            $table->integer('supervisor');
            $table->integer('status'); // 1 Undone , 2 Done , 3 On Going
            $table->text('title');
            $table->longText('keterangan');
            $table->boolean('is_visible');
            $table->integer('created_by');
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
        Schema::dropIfExists('jadwal');
    }
}
