<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableNotificationSetup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_setup', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title');
            $table->longText('body');
            $table->integer('type')->unsigned(); // 1 - broadcast , 2 - single
            $table->integer('created_by')->unsigned();
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
        Schema::dropIfExists('notification_setup');
    }
}
