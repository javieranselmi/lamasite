<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCiclesToLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('likes', function (Blueprint $table) {
            $table->integer('folder_id')->nullable()->unsigned();
            $table->foreign('folder_id')
                ->references('id')
                ->on('folders')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('likes', function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();
            $table->dropForeign(['folder_id']);
            $table->dropColumn('folder_id');
            Schema::enableForeignKeyConstraints();
        });
    }
}
