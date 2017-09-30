<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNotNullsToCourseStages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course_stages', function (Blueprint $table) {
            $table->integer('ppt_url')->nullable()->change();
            $table->integer('video_url')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course_stages', function (Blueprint $table) {
            $table->integer('ppt_url')->change();
            $table->integer('video_url')->change();
        });
    }
}
