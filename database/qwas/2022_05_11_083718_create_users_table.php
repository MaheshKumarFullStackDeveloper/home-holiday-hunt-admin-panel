<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('email_verification_token')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('is_email_verified', ['0','1'])->default('0')->comment("0:not verified,1:verified");
            $table->string('phone_number')->nullable();
             $table->string('country_code');
            $table->string('ip_address')->nullable();
            $table->enum('remember_me', ['0','1'])->default('0')->comment("0:not remembered, 1:remembered");
            $table->enum('login_with', ['1','2','3'])->default('1')->comment("1:email,2:gmail,3:facebook");
            $table->enum('user_locked', ['0','1'])->default('0')->comment("0:not locked, 1:locked");
            $table->timestamp('user_locked_at')->nullable();
            $table->tinyInteger('wrong_attempt')->default('0');
            $table->timestamp('last_login_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
