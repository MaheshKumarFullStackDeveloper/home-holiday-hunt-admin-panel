<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('session_id');
            $table->string('token');
            $table->string('status')->comment('1=>pending;2=>confirmed;3=>inprogress;4=>completed');
            $table->string('sub_total')->comment('The grand total of the order to be paid by the buyer excluding discount.');
            $table->string('item_discount')->comment('The total discount of the Order Items.');
            $table->string('tax')->comment('The tax on the Order Items.');
            $table->string('shipping')->comment('The shipping charges of the Order Items.');
            $table->string('overall_price')->comment('The total price of the Order including tax and shipping. It excludes the items discount.');
            $table->string('grand_total')->comment('The grand total of the order to be paid by the buyer.');
            $table->integer('is_assigned')->comment('0=>No;1=>Yes');
            $table->integer('delivery_person_id');
            $table->text('content')->comment('Extra information');
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
        Schema::dropIfExists('orders');
    }
}
