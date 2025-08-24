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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_code');
            $table->string('model_no');
            $table->string('hsn_code');
            $table->string('ean');
            $table->string('description');
            $table->string('gategory');
            $table->string('brand');
            $table->string('basic_allowance');
            $table->string('sta');
            $table->string('gst');
            $table->string('mrp');
            $table->string('mop');
            $table->string('product_status');
            $table->string('status')->default('Enable');
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
        Schema::dropIfExists('products');
    }
};
