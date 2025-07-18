<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->string('unit_250g')->nullable();
            $table->integer('unit_250g_price')->nullable();
            $table->string('unit_500g')->nullable();
            $table->integer('unit_500g_price')->nullable();
            $table->string('unit_1kg')->nullable(); 
            $table->integer('unit_1kg_price')->nullable();
            $table->string('image_url')->nullable();    
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
        Schema::dropIfExists('product_variants');
    }
}
