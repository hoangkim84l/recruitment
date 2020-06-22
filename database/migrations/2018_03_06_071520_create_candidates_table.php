<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCandidatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email', 50);
            $table->integer('gender')->unsigned();
            $table->integer('address_city_id')->unsigned();
            $table->foreign('address_city_id')->references('id')->on('cities');
            $table->string('phone_number', 20)->nullable();
            $table->text('tags');
            $table->string('cv_url', 100)->nullable();
            $table->integer('email_receive_flg')->unsigned();
            $table->integer('delete_flg')->unsigned();
            $table->dateTime('deleted_at')->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('modified_by')->unsigned()->nullable();
            $table->dateTime('created')->nullable();
            $table->dateTime('modified')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidates');
    }
}
