<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
     Schema::table('orders', function (Blueprint $table) {
        $table->string('lat')->nullable()->default(null)->after('is_assigned');
        $table->string('lng')->nullable()->default(null)->after('lat');
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
        $table->dropColumn('lat');
        $table->dropColumn('lng');
    });
    }
}
