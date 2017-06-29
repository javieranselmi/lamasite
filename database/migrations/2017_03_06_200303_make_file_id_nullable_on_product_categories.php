<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class MakeFileIdNullableOnProductCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_categories', function (Blueprint $table) {
            $table->integer('file_id')->unsigned()->nullable()->change();
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
        DB::statement('UPDATE `product_categories` SET `file_id` = 0 WHERE `file_id` IS NULL;');
        DB::statement('ALTER TABLE `product_categories` MODIFY `file_id` INTEGER UNSIGNED NOT NULL;');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
