<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCommentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comment', function(Blueprint $table)
		{
			$table->bigInteger('commentId', true)->unsigned();
			$table->bigInteger('referenceDetailId')->nullable()->index('comment_index_1');
			$table->bigInteger('userId')->nullable();
			$table->string('userName')->nullable();
			$table->bigInteger('parentCommentId')->nullable()->default(0);
			$table->text('commentText', 65535)->nullable();
			$table->dateTime('commentedDate')->default('0000-00-00 00:00:00');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('comment');
	}

}
