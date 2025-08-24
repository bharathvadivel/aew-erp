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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('service_id');
            $table->string('name');
            $table->string('service_center_name');
            $table->string('phone');
            $table->string('password');
            $table->string('email');
            $table->string('gstin_no')->nullable();
            $table->string('location_id')->nullable();
            $table->longText('address');
            $table->string('pincode');
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
        Schema::dropIfExists('services');
    }
};
