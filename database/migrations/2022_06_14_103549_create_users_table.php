<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('first_name')->nullable();
			$table->string('last_name')->nullable();
			$table->string('email')->nullable()->unique();
			$table->string('profile_picture')->nullable();	
			$table->enum('gender', ['1','2','3'])->comment("1=>male,2=>female,3=>transgender")->nullable();
            $table->enum('sexual_orientation', ['1','2','3','4'])->comment("1=>Straight;2=>Gay;3=>Lesbian;4=>Biosexual")->nullable();   
            $table->enum('ethinicity', ['1','2','3','4','5'])->comment("1=>White;2=>Hispanic or Latino;3=>Asian;4=>Black or African;5=>Multiracial")->nullable();
            $table->enum('trip_style', ['1','2','3'])->comment("1=>Backpacking;2=>Mid-range;3=>Luxury")->nullable();  
            $table->enum('trip_timeline', ['1','2','3'])->comment("1=>1-3 months;2=> 3-6 months; 3=>6-9 months;")->nullable();  
            $table->date('dob')->nullable(); 
            $table->enum('preferred_lang', ['1','2','3','4','5','6'])->default('1')->comment("1:English,2:Spanish,3:Chinease,4:Portuguese,5:Arabic,6:Hindi")->nullable();
            $table->string('bio')->comment('short description about the person')->nullable();
			$table->text('profile_updated_from')->nullable()->comment('1=>mobile;0=>web');
			$table->string('password')->nullable();
			$table->string('email_verification_token')->nullable();
			$table->dateTime('email_verified_at')->nullable();
			$table->enum('is_email_verified', array('0','1'))->default('0')->comment('0:not verified,1:verified');
			$table->string('phone_number')->nullable();
			$table->string('country_code');
			$table->string('ip_address')->nullable();
			$table->enum('remember_me', array('0','1'))->default('0')->comment('0:not remembered, 1:remembered');
			$table->text('remember_token')->nullable();
			$table->text('device_token')->nullable();
			$table->enum('login_with', array('1','2','3'))->default('1')->comment('1:email,2:gmail,3:facebook');
			$table->enum('user_locked', array('0','1'))->default('0')->comment('0:not locked, 1:locked');
			$table->dateTime('user_locked_at')->nullable();
			$table->boolean('wrong_attempt')->default(0);
			$table->dateTime('last_login_at')->nullable();
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
		Schema::drop('users');
	}

}
