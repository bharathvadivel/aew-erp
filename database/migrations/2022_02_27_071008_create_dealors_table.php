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
        Schema::create('dealors', function (Blueprint $table) {
            $table->id();
            $table->string('dealor_id');
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
            $table->string('credit_limit');
            $table->string('credit_days');
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
        Schema::dropIfExists('dealors');
    }
};
