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
        Schema::create('pricemasters', function (Blueprint $table) {
            $table->id();
            $table->string('partner_name');
            $table->string('partner_id');
            $table->string('partner_type');
            $table->string('model_no');
            $table->string('mop');
            $table->string('billing_price');
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
        Schema::dropIfExists('pricemasters');
    }
};
