<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBonusHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bonus_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('apply_id')->unsigned();
            $table->foreign('apply_id')->references('id')->on('applies');
            $table->integer('scouter_id')->unsigned();
            $table->foreign('scouter_id')->references('id')->on('scouters');
            $table->integer('bonusstatus_id')->unsigned();
            $table->integer('bonus_money')->unsigned();
            $table->integer('delete_flg')->unsigned();
            $table->dateTime('deleted_at')->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('modified_by')->unsigned()->nullable();
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
        Schema::dropIfExists('bonus_histories');
    }
}
