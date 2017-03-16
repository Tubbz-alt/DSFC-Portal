<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmconceptreferencedataTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('emconceptreferencedata', function(Blueprint $table)
		{
			$table->increments('conceptReferenceDataId');
			$table->integer('userId');
			$table->string('fileTitle', 200);
			$table->text('fileDescription', 65535);
			$table->string('fileName', 200);
			$table->string('filePath', 200);
			$table->integer('crossReferenceId');
			$table->boolean('status')->default(0);
			$table->integer('qualityIssues')->nullable()->default(0);
			$table->string('qualityIssuesCount', 200)->nullable();
			$table->string('importDataType', 200)->nullable();
			$table->dateTime('createdDate')->default('0000-00-00 00:00:00');
			$table->dateTime('updatedDate')->default('0000-00-00 00:00:00');
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
