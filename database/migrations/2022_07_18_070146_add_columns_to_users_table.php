<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('style_type')->comment('1=>Backpacking;2=>Mid-Range;3=>Luxury')->after('ethinicity')->nullable();
            $table->integer('travelling_duration')->comment('1=>1-3 months;2=>3-6 months; 3=> 6-12 months')->after('style_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('style_type');
            $table->dropColumn('travelling_duration');
        });
    }
}
