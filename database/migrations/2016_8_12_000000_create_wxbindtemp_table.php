<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWxbindTempTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wxtemp', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('userid')->unique();
            $table->string('wx_openid')->unique();
            $table->integer('set_time');
            $table->string('nick');
            $table->string('icon');
            $table->string('session_id')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('wxtemp');
    }
}
