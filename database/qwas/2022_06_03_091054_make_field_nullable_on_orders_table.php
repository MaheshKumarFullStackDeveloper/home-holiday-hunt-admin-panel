<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeFieldNullableOnOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('orders', function (Blueprint $table) {
        //     $table->integer('overall_price')->nullable()->change();
        //     $table->integer('shipping')->nullable()->change();
        //     $table->integer('tax')->nullable()->change();
        //     $table->integer('item_discount')->nullable()->change();
        //     $table->integer('sub_total')->nullable()->change();
        //     $table->integer('content')->nullable()->change();

        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('orders', function (Blueprint $table) {
        //     $table->integer('overall_price')->unsigned()->nullable(false)->change();
        //     $table->integer('shipping')->unsigned()->nullable(false)->change();
        //     $table->integer('tax')->unsigned()->nullable(false)->change();
        //     $table->integer('item_discount')->unsigned()->nullable(false)->change();
        //     $table->integer('sub_total')->unsigned()->nullable(false)->change();
        //     $table->integer('content')->unsigned()->nullable(false)->change();
        // });
    }
}
