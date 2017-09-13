<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoldersTable extends Migration
{
    public function up()
    {
        Schema::create('folders', function(Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->string("folder_name")->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::drop('folders');
        Schema::enableForeignKeyConstraints();
    }
}
