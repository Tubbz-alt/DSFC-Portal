<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmdatawizardTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('emdatawizard', function(Blueprint $table)
		{
			$table->integer('dataId', true);
			$table->integer('referenceDetailId');
			$table->string('mappingComments')->nullable();
			$table->string('datasetBelongs')->nullable();
			$table->string('dataItem')->nullable();
			$table->string('mappingInfo')->nullable();
			$table->integer('nationalDataId')->nullable();
			$table->string('sharePointLink', 250)->nullable();
			$table->integer('status')->nullable()->default(0);
			$table->boolean('mappedStatus')->default(1);
			$table->integer('mappedCodedStatus')->default(0);
			$table->timestamp('createdDate')->default(DB::raw('CURRENT_TIMESTAMP'));
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
		Schema::drop('emdatawizard');
	}

}
