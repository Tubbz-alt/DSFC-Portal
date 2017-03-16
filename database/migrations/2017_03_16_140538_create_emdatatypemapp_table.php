<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmdatatypemappTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('emdatatypemapp', function(Blueprint $table)
		{
			$table->integer('dataTypeId', true);
			$table->integer('dataMappedId')->nullable();
			$table->string('dataTypeName', 200)->nullable();
			$table->string('dataTypeMapName', 200);
			$table->integer('datatypeMapStatus')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('emdatatypemapp');
	}

}
