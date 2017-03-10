<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmfeedbackTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('emfeedback', function(Blueprint $table)
		{
			$table->integer('feedbackId', true);
			$table->string('subject', 250)->nullable();
			$table->string('description', 250)->nullable();
			$table->string('name', 250)->nullable();
			$table->string('email', 250)->nullable();
			$table->string('url', 250)->nullable();
			$table->string('title', 250)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('emfeedback');
	}

}
