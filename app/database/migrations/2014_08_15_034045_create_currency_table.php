<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrencyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('currency', function($table) 
		{
			$table->increments('id');
			$table->char('code', 3);
			$table->char('symbol', 3);
			$table->string('description');
			$table->string('country_name');
			$table->timestamp('created_at');
			$table->string('created_by');
			$table->timestamp('updated_at');
			$table->string('updated_by');
			$table->timestamp('deleted_at');
			$table->string('deleted_by');
			$table->boolean('is_deleted');	
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::drop('currency');
	}

}
