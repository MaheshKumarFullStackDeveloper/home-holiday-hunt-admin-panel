<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDestinationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('destinations', function (Blueprint $table) {
             $table->id();
             $table->string('dest_name');
             $table->string('dest_image')->nullable();
             $table->string('dest_lat');
             $table->string('dest_lng');
            $table->enum('dest_image_updated_from',['1','0'])->default('0')->comment('0:web, 1:mobile');
             $table->enum('dest_status',['1','0'])->default('1')->comment('1:active, 0:inactive');
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
        Schema::drop('destinations');
    }
}
