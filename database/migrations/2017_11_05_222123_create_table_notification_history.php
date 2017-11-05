<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableNotificationHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_history', function (Blueprint $table) {
            $table->increments('id');
            $table->text('id_notification_setup');
            $table->integer('status')->unsigned(); // 1 - Sent , 2 - Done, 3 - Failed
            $table->integer('receiver')->unsigned();
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
        Schema::dropIfExists('notification_history');
    }
}
