<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionPlanTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('subscription_plan', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('plan_name');
			$table->string('plan_duration')->comment('1 month;6 month; 12 month');
			$table->string('plan_price');
			$table->string('plan_status')->default('1')->comment('1=>active;0=>inactive');
			$table->softDeletes();
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
		Schema::drop('subscription_plan');
	}

}
