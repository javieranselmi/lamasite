<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCourseToComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->integer('course_id')->unsigned()->nullable();
            $table->foreign('course_id')
                ->references('id')
                ->on('courses')
                ->onDelete('cascade');

            $table->integer('post_id')->unsigned()->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();
            $table->dropColumn('course_id');

            DB::statement('UPDATE `comments` SET `post_id` = 0 WHERE `post_id` IS NULL;');
            DB::statement('ALTER TABLE `comments` MODIFY `post_id` INTEGER UNSIGNED NOT NULL;');
            Schema::enableForeignKeyConstraints();
        });
    }
}
