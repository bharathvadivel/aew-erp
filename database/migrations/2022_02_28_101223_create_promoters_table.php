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
        Schema::create('promoters', function (Blueprint $table) {
            $table->id();
            $table->string('promoter_id');
            $table->string('name');
            $table->string('phone');
            $table->string('password');
            $table->string('proof')->nullable();
            $table->string('email');
            $table->date('dob');
            $table->string('dealor_id');
            $table->longText('address');
            $table->string('pin_code');
            $table->string('city');
            $table->string('district');
            $table->string('state');
            $table->string('country');
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
        Schema::dropIfExists('promoters');
    }
};
