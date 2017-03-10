<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmnationalcodedvaluesSamplTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('emnationalcodedvalues_sampl', function(Blueprint $table)
		{
			$table->integer('codedValueId', true);
			$table->string('ddItemName', 250)->nullable();
			$table->string('ddItemAttrName', 250)->nullable();
			$table->string('ddItemCodeText', 250)->nullable();
			$table->string('ddCodedValueDescription', 250)->nullable();
			$table->string('ddCodedValueDescriptionChars', 250)->nullable();
			$table->string('isLatest', 250)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('emnationalcodedvalues_sampl');
	}

}
