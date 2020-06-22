<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
              $table->increments('id');
            $table->string('name', 50);
            $table->string('email', 50)->unique();
            $table->string('token', 100);
            $table->string('password', 50);
            $table->string('role', 11);
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
        Schema::dropIfExists('users');
    }
}
