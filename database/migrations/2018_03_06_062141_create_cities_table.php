<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 3);
            $table->string('name', 50);
            $table->string('alias', 50);
            $table->text('description');
            $table->integer('list_order')->unsigned();
            $table->integer('delete_flg')->unsigned();;
            $table->dateTime('deleted_at');
            $table->string('created_by', 11);
            $table->string('modified_by', 11);            
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
        Schema::dropIfExists('cities');
    }
}
