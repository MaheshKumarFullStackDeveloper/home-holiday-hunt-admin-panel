<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_reviews', function (Blueprint $table) {
            $table->id();
            $table->integer('reported_by')->nullable();
            $table->integer('reported_to')->nullable();
            $table->integer('flexibility_rate')->nullable();
            $table->integer('positivity_rate')->nullable(); 
            $table->integer('sense_of_humor_rate')->nullable();
            $table->integer('respectful_rate')->nullable();
            $table->integer('honesty_rate')->nullable();
            $table->integer('open_mind_rate')->nullable();
            $table->text('comment')->nullable();    
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
        Schema::dropIfExists('user_reviews');
    }
}
