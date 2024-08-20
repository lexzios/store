<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('products', function($table) 
		{
			$table->increments('id');
			$table->integer('product_category_id');
			$table->char('currency_code', 3);
			$table->integer('formula_id');
			$table->string('permalink');
			$table->string('name');
			$table->text('short_description');
			$table->text('long_description');
			$table->decimal('base_price', 15, 2);
			$table->boolean('is_sale');
			$table->decimal('streak_price', 15, 2);
			$table->boolean('is_call_for_best_price');
			$table->boolean('is_in_editor_pick');
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
		Schema::drop('products');
	}

}
