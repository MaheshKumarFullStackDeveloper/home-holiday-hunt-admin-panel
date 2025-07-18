<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
    */
    public function up() {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('content_english');
            $table->longText('content_spanish');
            $table->longText('content_chinease');
            $table->longText('content_portuguese');
            $table->longText('content_arabic');
            $table->longText('content_hindi');
            $table->string('section');
            $table->enum('device_type', ['web', 'mobile'])->default('web');
            $table->timestamp('last_updated_at');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->softDeletes();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
    */
    public function down() {
        Schema::dropIfExists('pages');
    }
}
