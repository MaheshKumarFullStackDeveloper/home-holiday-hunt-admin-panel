<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUnitUpdatedAtToProductVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_variants', function (Blueprint $table) {
            $table->timestamp('unit_250g_stock_updated_at')->after('unit_250g_stock')->nullable();
            $table->timestamp('unit_500g_stock_updated_at')->after('unit_500g_stock')->nullable();
            $table->timestamp('unit_1kg_stock_updated_at')->after('unit_1kg_stock')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_variants', function (Blueprint $table) {
            $table->dropColumn('unit_250g_stock_updated_at');
            $table->dropColumn('unit_500g_stock_updated_at');
            $table->dropColumn('unit_1kg_stock_updated_at');
        });
    }
}
