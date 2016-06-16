<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //create table for years
        Schema::create('years', function(Blueprint $table){
            $table->increments('id');
            $table->string('year_title');
            $table->integer('year_active');
            $table->timestamps();
        });
        //create table for semesters
        Schema::create('semesters', function(Blueprint $table){
            $table->increments('id');
            $table->string('semester_title');
            $table->integer('year_id')->unsigned();
            $table->timestamps();

            $table->foreign('year_id')->references('id')->on('years')
            ->onUpdate('cascade')->onDelete('cascade');

        });

        //create table for classes
        Schema::create('subjects', function(Blueprint $table){
            $table->increments('id');
            $table->string('subject_code');
            $table->string('subject_title');
            $table->integer('semester_id')->unsigned();
            $table->timestamps();

            $table->foreign('semester_id')->references('id')->on('semesters')
            ->onUpdate('cascade')->onDelete('cascade');
        });


        Schema::create('fileentries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('filename');
            $table->string('mime');
            $table->string('original_filename');
            $table->integer('subject_id')->unsigned();
            $table->timestamps();

            $table->foreign('subject_id')->references('id')->on('subjects')->onUpdate('cascade')->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //drop all tables
        Schema::drop('years');
        Schema::drop('semesters');
        Schema::drop('subjects');
        Schema::drop('fileentries');
    }
}
