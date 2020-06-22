<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobstatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobstatus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->integer('list_order')->unsigned();
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
        Schema::dropIfExists('jobstatus');
    }
}
