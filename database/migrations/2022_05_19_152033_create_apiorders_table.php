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
        Schema::create('apiorders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->string('partner_id')->nullable();
            $table->string('partner_type');
            $table->string('to_id');
            $table->string('store_name');
            $table->string('name');
            $table->string('phone');
            $table->string('location_id')->nullable();
            $table->longText('address');
            $table->string('city');
            $table->string('district');
            $table->string('state');
            $table->string('country');
            $table->float('grand_total',15,2);
            $table->string('order_by');
            $table->string('order_type')->nullable();
            $table->string('created_id');
            $table->string('status')->default('Pending');
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
        Schema::dropIfExists('apiorders');
    }
};
