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
        Schema::create('distributorserials', function (Blueprint $table) {
            $table->id();
            $table->string('partnerinvoices_id');
            $table->string('partnerinvoice_no');
            $table->string('serial_no')->nullable();
             $table->string('gategory')->nullable();
            $table->string('description')->nullable();
            $table->string('model_no')->nullable();
            $table->string('product_code')->nullable();
            $table->string('partner_name')->nullable();
            $table->string('partner_id')->nullable();
            $table->string('sub_location_id')->nullable();
            $table->string('remarks')->nullable();
            $table->string('status')->default('unused');
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
        Schema::dropIfExists('distributorserials');
    }
};
