<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('admins', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('first_name')->nullable();
			$table->string('last_name')->nullable();
			$table->string('name')->nullable();
			$table->integer('role_id');
			$table->string('email')->unique();
			$table->string('email_verification_token')->nullable();
			$table->enum('is_email_verified', array('0','1'))->default('0')->comment('0:not verified,1:verified');
			$table->dateTime('email_verified_at')->nullable();
			$table->string('password');
			$table->string('phone_number')->nullable();
			$table->string('country_code')->nullable();
			$table->string('ip_address')->nullable();
			$table->enum('remember_me', array('0','1'))->default('0')->comment('0:not remembered, 1:remembered');
			$table->enum('user_locked', array('0','1'))->default('0')->comment('0:not locked, 1:locked');
			$table->dateTime('user_locked_at')->nullable();
			$table->boolean('wrong_attempt')->default(0);
			$table->timestamps(6);
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('admins');
	}

}
