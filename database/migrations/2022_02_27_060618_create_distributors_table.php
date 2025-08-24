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
        Schema::create('distributors', function (Blueprint $table) {
            $table->id();
            $table->string('partner_type');
            $table->string('partner_id');
            $table->string('created_id');
            $table->string('store_name');
            $table->string('name');
            $table->string('email');
            $table->date('dob');
            $table->string('gstin_no')->nullable();
            $table->string('phone');
            $table->string('password');
            $table->string('state');
            $table->string('available_limit');
            $table->string('credit_limit');
            $table->string('credit_days');
            $table->string('country');
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
        Schema::dropIfExists('distributors');
    }
};
