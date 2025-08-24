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
        Schema::create('bajajs', function (Blueprint $table) {
            $table->id();
            $table->string('brand_name');
            $table->string('gategory_name');
            $table->string('product_code');
            $table->string('description');
            $table->string('model_no');
            $table->string('serial_no');
            $table->string('status')->default('unused');

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
        Schema::dropIfExists('bajajs');
    }
};
