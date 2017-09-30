<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            // Constraints declaration

<<<<<<< HEAD
            $table->integer('file_id')->unsigned();
            $table->foreign('file_id')->references('id')->on('files');
=======
            $table->integer('file_id')->unsigned()->nullable();
            $table->foreign('file_id')->references('id')->on('files');
            $table->string('image_url');
>>>>>>> 455767302861fb413b9a75a2ff59ca1bcaabf87f
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
        Schema::disableForeignKeyConstraints();
        Schema::drop('courses');
        Schema::enableForeignKeyConstraints();
    }
}
