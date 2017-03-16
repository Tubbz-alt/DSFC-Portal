<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmgroupinfoDataTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('emgroupinfo_data', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('group_id');
			$table->integer('reference_data_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('emgroupinfo_data');
	}

}
