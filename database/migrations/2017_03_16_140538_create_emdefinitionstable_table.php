<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmdefinitionstableTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('emdefinitionstable', function(Blueprint $table)
		{
			$table->integer('definitionID', true);
			$table->integer('referenceDetailId');
			$table->string('dataItemName', 250)->nullable();
			$table->string('dataItemDescription', 250)->nullable();
			$table->string('codedValue', 250)->nullable();
			$table->string('codedValueType', 250)->nullable();
			$table->string('codedValueDescription', 250)->nullable();
			$table->string('dataItemId', 250)->nullable();
			$table->string('dataItemVersionId', 250)->nullable();
			$table->string('codedValueId', 250);
			$table->string('codedValueVersionId', 250)->nullable();
			$table->string('author', 200)->nullable();
			$table->integer('isMapped')->default(0);
			$table->integer('isMappedApprove')->default(0);
			$table->integer('mappedCodedStatus')->default(0);
			$table->integer('dataTypeSetStatus')->nullable()->default(0);
			$table->integer('mappedCodedComplete')->default(0);
			$table->string('additionalData', 250)->nullable();
			$table->timestamp('createdDate')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->dateTime('uploadedDate')->default('0000-00-00 00:00:00');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('emdefinitionstable');
	}

}
