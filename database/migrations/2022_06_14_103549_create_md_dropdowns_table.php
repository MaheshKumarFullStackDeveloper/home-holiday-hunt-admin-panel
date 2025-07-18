<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMdDropdownsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('md_dropdowns', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('name')->nullable();
			$table->string('slug')->nullable();
			$table->string('values')->nullable();
			$table->string('country')->nullable();
			$table->enum('status', array('0','1'))->nullable()->default('1')->comment('0:not available, 1:available');
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
		Schema::drop('md_dropdowns');
	}

}
