<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id')->unsigned();
            $table->foreign('member_id')->references('id')->on('users');
            $table->integer('country_id')->unsigned();
            $table->foreign('country_id')->references('id')->on('countries');
            $table->string('name', 50);
            $table->integer('work_from')->unsigned();
            $table->integer('work_to')->unsigned();
            $table->integer('overtime_id')->unsigned();
            $table->integer('company_type_id')->unsigned();
            $table->text('address');
            $table->integer('address_city_id')->unsigned();
            $table->foreign('address_city_id')->references('id')->on('cities');
            $table->string('phone_number', 20);
            $table->string('representative', 50);
            $table->string('web_url', 100);
            $table->string('members', 50);
            $table->string('foundation_date', 50);
            $table->text('description');
            $table->string('banner_url', 100);
            $table->string('logo_url', 100);
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
        Schema::dropIfExists('companies');
    }
}
