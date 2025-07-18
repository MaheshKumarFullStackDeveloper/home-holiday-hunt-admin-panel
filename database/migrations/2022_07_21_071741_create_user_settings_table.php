<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('is_show_age')->comment('1=>yes;0=>No')->nullable();
            $table->integer('gender_preference')->comment('1=>male,2=>female,3=>transgender;4=>Everyone')->nullable();
            $table->integer('min_age')->nullable();
            $table->integer('max_age')->nullable();
            $table->integer('ethinicity_preference')->comment('1=>White;2=>Hispanic or Latino;3=>Asian;4=> Black or African; Multiracial;5=>Everyone')->nullable();
            $table->integer('sexual_orientation_preference')->comment('1=>Straight;2=>Gay;3=>Lesbian;4=>Biosexual;5=>Everyone')->nullable();
            $table->integer('trip_style_preference')->comment('1=>Backpacking;2=>Mid-range;3=>Luxury;4=>Everyone')->nullable();
            $table->integer('trip_timeline_preference')->comment('1=>1-3 months;2=> 3-6 months; 3=>6-9 months; 4=> Everyone')->nullable();
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
        Schema::dropIfExists('user_settings');
    }
}
