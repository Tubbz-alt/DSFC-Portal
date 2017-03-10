<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmtnrconnecteddataTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('emtnrconnecteddata', function(Blueprint $table)
		{
			$table->integer('tnrConnectId', true);
			$table->integer('dataLocalId')->nullable();
			$table->integer('tnrDataId')->nullable();
			$table->integer('tnrConnectStatus')->nullable()->default(0);
			$table->dateTime('createdDate')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('emtnrconnecteddata');
	}

}
