<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDataDictionaryMainTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('data_dictionary_main', function(Blueprint $table)
		{
			$table->string('Attr_Name')->nullable();
			$table->string('Valid_From', 500)->nullable();
			$table->string('Valid_To', 500)->nullable();
			$table->string('Main_Code_Text', 50)->nullable();
			$table->string('Sub_Code1_Text', 50)->nullable();
			$table->string('Sub_Code2_Text', 50)->nullable();
			$table->string('Sub_Code3_Text', 50)->nullable();
			$table->string('Major_Category')->nullable();
			$table->string('Category')->nullable();
			$table->text('Main_Description', 65535)->nullable();
			$table->string('Main_Description_60_Chars', 60)->nullable();
			$table->text('Sub1_Description', 65535)->nullable();
			$table->text('Sub2_Description', 65535)->nullable();
			$table->text('Sub3_Description', 65535)->nullable();
			$table->text('Notes', 65535)->nullable();
			$table->integer('In_Source_Table')->nullable();
			$table->text('Unique_Column', 65535)->nullable();
			$table->string('Import_Date', 500)->nullable();
			$table->string('Created_Date', 500)->nullable();
			$table->integer('Is_Latest')->nullable();
			$table->string('Effective_From', 500)->nullable();
			$table->string('Effective_To', 500)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('data_dictionary_main');
	}

}
