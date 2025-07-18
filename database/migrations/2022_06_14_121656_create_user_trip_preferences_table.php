<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTripPreferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_trip_preferences', function (Blueprint $table) {
            $table->bigInteger('id');
            $table->text('trip_budget_type')->comment('backpacking=>1,medium-range=>2,luxury=>3');
            $table->text('trip_timeline')->comment('1-3 months=>1, 3-6 months=>2, 6-12 months=>3');
            $table->text('trip_description');
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
        Schema::drop('user_trip_preferences');
    }
}
