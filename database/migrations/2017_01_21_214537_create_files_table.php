<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    public function up()
    {
        Schema::create('files', function(Blueprint $table) {
            $table->increments('id');
<<<<<<< HEAD
            $table->string("file_name");
            $table->string("mime")->nullable();
=======
            $table->string("file_name_original");
            $table->string("file_name");
            $table->string("mime");
>>>>>>> 455767302861fb413b9a75a2ff59ca1bcaabf87f
            // Schema declaration
            // Constraints declaration
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::drop('files');
        Schema::enableForeignKeyConstraints();
    }
}
