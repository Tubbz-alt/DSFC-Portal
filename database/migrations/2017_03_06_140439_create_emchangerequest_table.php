<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmchangerequestTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('emchangerequest', function(Blueprint $table)
		{
			$table->integer('requestId', true);
			$table->integer('referenceDetailId');
			$table->integer('status')->default(0);
			$table->string('requestComments', 200)->nullable();
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
		Schema::drop('emchangerequest');
	}

}
