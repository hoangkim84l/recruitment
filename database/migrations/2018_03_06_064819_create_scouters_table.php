<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScoutersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scouters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id')->unsigned();
            $table->foreign('member_id')->references('id')->on('users');
            $table->string('id_card', 50);
            $table->dateTime('birth_day');
            $table->text('address');
            $table->integer('address_city_id')->unsigned();
            $table->foreign('address_city_id')->references('id')->on('cities');
            $table->string('phone_number', 20);
            $table->string('avatar_url', 100);
            $table->integer('email_receive_flg')->unsigned();
            $table->integer('delete_flg')->unsigned();
            $table->dateTime('deleted_at');
            $table->integer('created_by')->unsigned();
            $table->integer('modified_by')->unsigned();
            $table->dateTime('created');
            $table->dateTime('modified');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scouters');
    }
}
