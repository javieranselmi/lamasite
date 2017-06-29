<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubcategoryToProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('product_category_id')->unsigned()->nullable()->change();

            $table->integer('product_subcategory_id')->unsigned()->nullable();
            $table->foreign('product_subcategory_id')->references('id')->on('product_subcategories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {

            Schema::disableForeignKeyConstraints();
            $table->dropForeign(['product_subcategory_id']);
            $table->dropColumn('product_subcategory_id');
            DB::statement('UPDATE `products` SET `product_category_id` = 0 WHERE `product_category_id` IS NULL;');
            DB::statement('ALTER TABLE `products` MODIFY `product_category_id` INTEGER UNSIGNED NOT NULL;');
            Schema::enableForeignKeyConstraints();
        });
    }
}
