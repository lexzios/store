<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestimonialsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('testimonials', function($table) 
		{
			$table->increments('id');
			$table->string('name');
			$table->string('email');
			$table->string('country');
			$table->text('testimonial');
			$table->boolean('is_approved');
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
		Schema::drop('testimonials');
	}

}
