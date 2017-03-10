<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmaeadatadefinitionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('emaeadatadefinition', function(Blueprint $table)
		{
			$table->integer('tnrId', true);
			$table->string('dataBaseName', 250)->nullable();
			$table->string('tableName', 250)->nullable();
			$table->string('tnrItemName', 250)->nullable();
			$table->string('tnrDataItemDescription', 250)->nullable();
			$table->string('dataType', 250)->nullable();
			$table->string('required', 250)->nullable();
			$table->string('codeTbc', 250)->nullable();
			$table->string('codeDescriptionTbc', 250)->nullable();
			$table->string('isDerivedItem', 250)->nullable();
			$table->string('derivationMethodology', 250)->nullable();
			$table->string('authorName', 250)->nullable();
			$table->string('createdDate', 250)->nullable();
			$table->string('dataDictionaryName', 250)->nullable();
			$table->string('dataDictionaryLinks', 250)->nullable();
			$table->integer('referenceId')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('emaeadatadefinition');
	}

}
