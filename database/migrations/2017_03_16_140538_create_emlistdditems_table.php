<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmlistdditemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('emlistdditems', function(Blueprint $table)
		{
			$table->integer('itemId', true);
			$table->integer('referenceDetailId');
			$table->string('itemName', 250)->nullable();
			$table->string('itemType', 250)->nullable();
			$table->string('url', 250)->nullable();
			$table->timestamp('createdDate')->default(DB::raw('CURRENT_TIMESTAMP'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('emlistdditems');
	}

}
