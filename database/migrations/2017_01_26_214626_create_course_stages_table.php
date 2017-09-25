<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseStagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_stages', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->integer('duration_in_minutes');
            $table->string('type');
            $table->string('html')->nullable();
            $table->text('json_vid_ppt')->nullable();
            // Constraints declaration

            $table->integer('video_id')->nullable()->unsigned();
            $table->foreign('video_id')->references('id')->on('files');

            $table->integer('ppt_id')->nullable()->unsigned();
            $table->foreign('ppt_id')->references('id')->on('files');

            $table->integer('course_id')->unsigned();
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');

            $table->string('video_url');
            $table->string('ppt_url');

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
        Schema::drop('course_stages');
        Schema::enableForeignKeyConstraints();
    }
}
