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
        Schema::create('sales_executives', function (Blueprint $table) {
            $table->id();
            $table->string('sales_executive_id');
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->longText('address');
            $table->string('pin_code');
            $table->string('city')->nullable();
            $table->string('district')->nullable();
            $table->string('state');
            $table->string('country')->nullable();
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
        Schema::dropIfExists('sales_executives');
    }
};
