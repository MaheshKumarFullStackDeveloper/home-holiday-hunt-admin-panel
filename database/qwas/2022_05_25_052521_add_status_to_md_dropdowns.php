<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToMdDropdowns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('md_dropdowns', function (Blueprint $table) {
            
            $table->enum('status', ['0','1'])->default('1')->comment("0:not available, 1:available")->after('values')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('md_dropdowns', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
