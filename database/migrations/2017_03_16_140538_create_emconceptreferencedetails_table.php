<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmconceptreferencedetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('emconceptreferencedetails', function(Blueprint $table)
		{
			$table->increments('conceptReferenceDetailId');
			$table->integer('referenceDetailId');
			$table->string('dataItemName', 200)->nullable();
			$table->string('dataItemDescription', 200)->nullable();
			$table->string('dataType', 200)->nullable();
			$table->string('requirement', 200)->nullable();
			$table->string('code', 200)->nullable();
			$table->string('codeDescription', 200)->nullable();
			$table->string('isDerivedItem', 200)->nullable();
			$table->string('derivationMethodology', 200)->nullable();
			$table->string('author', 200)->nullable();
			$table->dateTime('createdDate')->default('0000-00-00 00:00:00');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('emconceptreferencedetails');
	}

}
