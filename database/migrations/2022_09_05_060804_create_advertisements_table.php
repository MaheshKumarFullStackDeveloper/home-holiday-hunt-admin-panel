<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->string('adv_txt')->nullable();
            $table->string('adv_image')->nullable();
            $table->string('adv_action_url')->nullable();
            $table->integer('adv_status')->comment('0=>inactive;1=>active')->default(1);
            $table->integer('adv_show_area')->comment('1=>Dashboard;2=>Chat List;3=>Chat View')->default(1);
            $table->text('adv_show_btw');
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
        Schema::dropIfExists('advertisements');
    }
}
