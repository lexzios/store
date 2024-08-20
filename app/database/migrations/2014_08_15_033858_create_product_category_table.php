<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCategoryTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('product_category', function($table) 
		{
			$table->increments('id');
			$table->integer('parent_id');
			$table->string('permalink');
			$table->string('name');
			$table->integer('sorting_id');
			$table->string('title_seo');
			$table->string('description_seo');
			$table->string('keyword_seo');
			$table->boolean('is_header');
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
		Schema::drop('product_category');
	}

}
