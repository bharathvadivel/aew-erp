<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amountcollects', function (Blueprint $table) {
            $table->id();
            $table->string('payment_mode');
            $table->string('reference_no')->nullable();
            $table->float('amount');
            $table->string('credit_limit')->nullable();
            $table->string('available_limit')->nullable();
            $table->string('partner_id');
            $table->string('partner_type');
            $table->string('partner_name')->nullable();
            $table->string('partner_store_name')->nullable();
            $table->string('proof')->nullable();
            $table->longText ('remarks')->nullable();
            $table->string('payment_status');
            $table->string('login_id')->nullable();
            $table->string('login_name')->nullable();
            $table->string('login_type')->nullable();
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
        Schema::dropIfExists('amountcollects');
    }
};
