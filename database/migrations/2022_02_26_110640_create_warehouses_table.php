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
        Schema::create('warehouses', function (Blueprint $table) {
            $table->id();
            $table->string('warehouse_id');
            $table->string('name');
            $table->string('email');
            $table->string('gstin_no')->nullable();
            $table->longText('address');
            $table->string('pin_code');
            $table->string('phone');
            $table->string('password');
            $table->string('city');
            $table->string('district');
            $table->string('state');
            $table->string('country');
            $table->string('lat')->nullable();
            $table->string('lang')->nullable();
            $table->string('created_id')->nullable();
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
        Schema::dropIfExists('warehouses');
    }
};
