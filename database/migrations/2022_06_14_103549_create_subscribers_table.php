<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscribersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('subscribers', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('user_id');
			$table->string('plan_id');
			$table->string('plan_start_date');
			$table->string('plan_end_date');
			$table->string('status');
			$table->timestamps(6);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('subscribers');
	}

}
