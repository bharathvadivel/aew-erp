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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('partner_id');
            $table->string('partner_type');
            $table->string('created_id');
            $table->string('name');
            $table->string('phone');
            $table->string('password');
            $table->string('email');
            $table->string('address');
            $table->string('city');
            $table->string('district');
            $table->string('pincode');
            $table->string('lat')->nullable();
            $table->string('lang')->nullable();
            $table->string('state');
            $table->string('country');
            $table->string('status');
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
        Schema::dropIfExists('admins');
    }
};
