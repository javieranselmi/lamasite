<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddThingsToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('subtitle');
            $table->integer('share_count')->unsigned()->default(0);
        });

        Schema::create('file_product', function (Blueprint $table) {
            $table->integer('file_id')->unsigned();
            $table->integer('product_id')->unsigned();

            $table->foreign('product_id')->references('id')->on('products')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('file_id')->references('id')->on('files')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['file_id', 'product_id']);
        });

        Schema::create('course_product', function (Blueprint $table) {
            $table->integer('course_id')->unsigned();
            $table->integer('product_id')->unsigned();

            $table->foreign('product_id')->references('id')->on('products')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['course_id', 'product_id']);
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
            $table->dropColumn("subtitle");
            $table->dropColumn("share_count");
        });
        Schema::drop('file_product');
        Schema::drop('course_product');
    }
}
