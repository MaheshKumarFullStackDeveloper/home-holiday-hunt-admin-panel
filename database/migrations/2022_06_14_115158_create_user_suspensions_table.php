<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSuspensionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_suspensions', function(Blueprint $table)
        {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('reported_by')->nullable();
            $table->string('reported_at')->nullable();
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
        Schema::drop('user_suspensions');
    }
}
