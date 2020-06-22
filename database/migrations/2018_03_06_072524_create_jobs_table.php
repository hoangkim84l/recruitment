<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('companies');
            $table->integer('job_type_id')->unsigned();
            $table->foreign('job_type_id')->references('id')->on('jobtypes');
            $table->string('name', 50);
            $table->integer('salary_from')->unsigned();
            $table->integer('salary_to')->unsigned();
            $table->integer('age_from')->unsigned();
            $table->integer('age_to')->unsigned();
            $table->integer('bonus')->unsigned();
            $table->text('tags');
            $table->text('working_time');
            $table->text('experience');
            $table->text('requirement');
            $table->text('description');
            $table->text('welfare');
            $table->text('address');
            $table->integer('address_city_id')->unsigned();
            $table->foreign('address_city_id')->references('id')->on('cities');
            $table->string('email_receive', 50);
            $table->integer('expire_date')->unsigned();
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
        Schema::dropIfExists('jobs');
    }
}
