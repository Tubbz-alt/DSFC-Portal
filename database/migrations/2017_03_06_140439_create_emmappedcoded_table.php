<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmmappedcodedTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('emmappedcoded', function(Blueprint $table)
		{
			$table->integer('mappedItemId', true);
			$table->integer('referenceDetailId')->nullable();
			$table->integer('localDataId')->nullable();
			$table->integer('nationaldataId')->nullable();
			$table->integer('mappedCodedStatus')->default(0);
			$table->string('mappedColor', 250)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('emmappedcoded');
	}

}
