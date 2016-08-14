<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWxUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wxusers', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('userid')->unique();
            $table->string('wx_openid')->unique();
            $table->dateTime('bind_time');
            $table->string('nick');
            $table->string('icon');
            $table->bigInteger('update_time');
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
        Schema::drop('wxusers');
    }
}
