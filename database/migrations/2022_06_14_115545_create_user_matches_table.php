<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_matches', function(Blueprint $table)
        {
            $table->bigInteger('id');
            $table->bigInteger('user_id');
            $table->bigInteger('requested_for');
            $table->text('is_approved');
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
        Schema::drop('user_matches');
    }
}
