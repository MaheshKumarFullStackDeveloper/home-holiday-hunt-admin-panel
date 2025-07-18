<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarkettingUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketting_users', function (Blueprint $table) {
            $table->bigInteger('id', true)->unsigned();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('country_code')->nullable();
            $table->string('phone_number')->nullable();
            $table->text('password')->nullable();
            $table->enum('preferred_lang', ['1','2','3','4','5','6'])->default('1')->comment("1:English,2:Spanish,3:Chinease,4:Portuguese,5:Arabic,6:Hindi")->nullable();
            $table->string('is_email_verified')->nullable();           
            $table->string('profile_picture')->nullable();
            $table->string('profile_updated_from')->nullable()->comment('1=>mobile;0=>web');
            $table->enum('gender', ['1','2','3'])->default(null)->comment("1:male,2:female,3:transgender")->nullable();
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
        Schema::drop('marketting_users');
    }
}
