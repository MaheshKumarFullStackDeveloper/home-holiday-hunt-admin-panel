<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropMultipleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('cart_items');
        Schema::dropIfExists('carts');
        Schema::dropIfExists('delivery_agents');
        Schema::dropIfExists('product_categories');
        Schema::dropIfExists('product_variants');
        Schema::dropIfExists('products');
        Schema::dropIfExists('hiacta_teams');
        Schema::dropIfExists('product_images');
        Schema::dropIfExists('user_addresses');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('session_id');
            $table->string('token');
            $table->integer('status');
            $table->string('user_name');
            $table->string('email');
            $table->string('phone_number');
            $table->string('country_code');
            $table->string('content')->comment('extra information');
            $table->timestamps();
        });
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->integer('cart_id');
            $table->string('price');
            $table->string('discount');
            $table->integer('quantity');
            $table->integer('active');
            $table->text('content')->comment('extra information');
            $table->timestamps();
        });
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->integer('order_id');
            $table->string('price');
            $table->string('discount');
            $table->string('quantity');
            $table->text('content')->coment('extra information');
            $table->timestamps();
        });
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
        Schema::create('delivery_agents', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('password')->nullable();
            $table->string('email_verification_token')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('is_email_verified', ['0','1'])->default('0')->comment("0:not verified,1:verified");
            $table->string('phone_number')->nullable();
            $table->enum('is_available', ['0','1'])->default('0')->comment("0:not available, 1:available");
            $table->enum('is_locked', ['0','1'])->default('0')->comment("0:not locked, 1:locked");
            $table->timestamp('locked_at')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('image_url')->nullable();  
            $table->softDeletes(); 
            $table->timestamps();
        });
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('hiacta_teams', function (Blueprint $table) {
            $table->id();
            $table->Integer('country_code');
            $table->string('phone_number');
            $table->timestamps();
        });
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->string('name')->nullable();
            $table->string('image_url')->nullable();
            $table->softDeletes();
            $table->timestamps();
             
        });
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('user_name');
            $table->text('address_line_1');
            $table->text('address_line_2')->nullable();
            $table->string('phone_number');
            $table->string('country_code');
            $table->string('is_active');
            $table->timestamps();
        });
       
    }
}
