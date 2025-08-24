<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transferserials', function (Blueprint $table) {
            $table->id();
            $table->string('transfer_no');
            $table->string('from_warehouse_id');
            $table->string('to_warehouse_id');
            $table->string('gategory');
            $table->string('product_code');
            $table->string('model_no');
            $table->string('description');
            $table->string('stock');
            $table->string('login_id')->nullable();
            $table->string('status')->default('transfered');
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
        Schema::dropIfExists('transferserials');
    }
};
