<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiveInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liveinfo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cid')->unique();
            $table->string('pid')->unique();
            $table->string('name');
            $table->string('url')->unique();
            $table->string('pic');
            $table->string('lssApp');
            $table->string('lssStream');
            $table->string('dmsPubKey');
            $table->string('dmsAppKey');
            $table->string('dmsSecKey');
            $table->string('dmsSubKey');
            $table->string('loginKey');
            $table->string('info_short');
            $table->string('info_long');
            $table->integer('category');
            $table->bigInteger('author')->unique();
            $table->boolean('playing');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('liveinfo');
    }
}
