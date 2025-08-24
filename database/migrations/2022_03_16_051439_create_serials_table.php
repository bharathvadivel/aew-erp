<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serials', function (Blueprint $table) {
            $table->id();
            $table->string('purchase_no');
            $table->string('gategory');
            $table->string('product_code');
            $table->string('model_no');
            $table->string('description');
            $table->string('warehouse_id');
            $table->string('serial_no')->nullable();
            $table->date('dom')->nullable();
            $table->string('status')->default('unused');
            $table->string('gst_value');
            $table->date('date')->nullable();;
            $table->string('suppliers');
            $table->string('price');
            $table->string('type');
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
        Schema::dropIfExists('serials');
    }
};
