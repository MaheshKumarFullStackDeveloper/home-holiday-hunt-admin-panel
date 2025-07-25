<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProfileUpdatedToDeliveryAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('delivery_agents', function (Blueprint $table) {
            $table->text('profile_updated_from')->comment("1=>mobile;0=>web")->after('profile_picture')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('delivery_agents', function (Blueprint $table) {
            $table->dropColumn('profile_updated_from');
        });
    }
}
