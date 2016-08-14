<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siteconfig', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('active');
            $table->string('wspcode');
            $table->string('appid');//微信公众号appid
            $table->string('appsecret');//微信公众号secret
            $table->integer('live_update_time');
            $table->integer('live_update_duration');
            $table->integer('user_update_duration');
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
        Schema::drop('siteconfig');
    }
}
