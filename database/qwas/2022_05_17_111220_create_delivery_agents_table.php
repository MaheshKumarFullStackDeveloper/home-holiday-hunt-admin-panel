<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_agents', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('password')->nullable();
            $table->string('email_verification_token')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('is_email_verified', ['0','1'])->default('0')->comment("0:not verified,1:verified");
            $table->string('phone_number')->nullable();
            $table->enum('is_available', ['0','1'])->default('0')->comment("0:not available, 1:available");
            $table->enum('is_locked', ['0','1'])->default('0')->comment("0:not locked, 1:locked");
            $table->timestamp('locked_at')->nullable();
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
        Schema::dropIfExists('delivery_agents');
    }
}
