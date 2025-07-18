<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->bigInteger('id', true)->unsigned();
            $table->Integer('country_id')->nullable();
            $table->string('city_name')->nullable();
            $table->string('city_image')->nullable();
            $table->enum('city_status', array('0','1'))->default('1');
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
        Schema::dropIfExists('cities');
    }
}
