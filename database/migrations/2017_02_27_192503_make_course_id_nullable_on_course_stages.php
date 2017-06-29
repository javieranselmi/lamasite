<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class MakeCourseIdNullableOnCourseStages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course_stages', function (Blueprint $table) {
            $table->integer('course_id')->unsigned()->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::statement('UPDATE `course_stages` SET `course_id` = 0 WHERE `course_id` IS NULL;');
        DB::statement('ALTER TABLE `course_stages` MODIFY `course_id` INTEGER UNSIGNED NOT NULL;');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
