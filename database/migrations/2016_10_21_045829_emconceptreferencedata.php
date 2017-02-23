<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Emconceptreferencedata extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emconceptreferencedata', function (Blueprint $table) {
            $table->increments('conceptReferenceDataId');
            $table->integer('userId');
            $table->string('fileTitle', 200);
            $table->text('fileDescription', 200);
            $table->string('fileName', 200);
            $table->string('filePath', 200);
            $table->integer('crossReferenceId');
            $table->tinyInteger('status')->default(0);
            $table->string('comments', 200);
            $table->timestamp('createdDate');

        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('emconceptreferencedata');
    }
}
