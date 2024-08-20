<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistributorProductTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('distributor_product', function($table) 
		{
			$table->increments('id');
			$table->integer('distributor_id');
			$table->string('name');
			$table->integer('product_id');
			$table->char('currency_code', 3);
			$table->decimal('distributor_product_price', 15, 2);
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
		Schema::drop('distributor_product');
	}

}
