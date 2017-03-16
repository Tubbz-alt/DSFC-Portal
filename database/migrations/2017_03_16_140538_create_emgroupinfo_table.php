<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmgroupinfoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('emgroupinfo', function(Blueprint $table)
		{
			$table->integer('groupId', true);
			$table->integer('referenceDetailId');
			$table->string('localPatientID')->nullable();
			$table->string('groupName')->nullable();
			$table->string('sex', 200)->nullable();
			$table->string('addressFormatCode', 200)->nullable();
			$table->integer('groupStatus')->nullable()->default(0);
			$table->string('groupType', 200)->nullable();
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
		Schema::drop('emgroupinfo');
	}

}
