<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ions_users', function($table) {
			$table->increments('id');
			$table->string('first_name', 50);
			$table->string('last_name', 50);
			$table->string('email', 100);
			$table->string('encrypted_password', 128);
			$table->string('remember_token', 128)->nullable();
			$table->timestamp('current_sign_in_at');
			$table->timestamp('last_sign_in_at');
			$table->timestamp('created_at');
			$table->string('created_by');
			$table->timestamp('updated_at');
			$table->string('updated_by');
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
		Schema::drop('ions_users');
	}

}
