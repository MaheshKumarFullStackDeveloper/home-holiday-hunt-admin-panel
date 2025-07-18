<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('name')->nullable();
            $table->integer('role_id'); 
            $table->string('email')->unique();
            $table->string('email_verification_token')->nullable();
            $table->enum('is_email_verified', ['0','1'])->default('0')->comment("0:not verified,1:verified");
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone_number')->nullable();
            $table->string('country_code')->nullable();
            $table->string('ip_address')->nullable();
            $table->enum('remember_me', ['0','1'])->default('0')->comment("0:not remembered, 1:remembered");
            $table->enum('user_locked', ['0','1'])->default('0')->comment("0:not locked, 1:locked");
            $table->timestamp('user_locked_at')->nullable();
            $table->tinyInteger('wrong_attempt')->default('0');
            $table->timestamps();
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
        Schema::dropIfExists('admins');
    }
}
