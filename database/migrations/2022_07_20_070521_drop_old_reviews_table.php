<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropOldReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::dropIfExists('reviews');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::create('reviews', function(Blueprint $table)
        {
            $table->bigInteger('id', true)->unsigned();
            $table->integer('user_id');
            $table->integer('order_id');
            $table->integer('delivery_agents_id');
            $table->string('rating')->nullable();
            $table->enum('submitted_by', array('1','2'))->comment('1:user , 2:delivery agent');
            $table->text('description')->nullable();
            $table->timestamps(6);
        });
    }
}
