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
        Schema::create('disserials', function (Blueprint $table) {
            $table->id();
            $table->string('disinvoices_id');
            $table->string('disinvoice_no');
            $table->string('disinvoices_salereturn_id')->nullable();
            $table->string('salereturn_no')->nullable();
            $table->string('serial_no')->nullable();
            $table->string('gategory')->nullable();
            $table->string('description')->nullable();
            $table->string('model_no')->nullable();
            $table->string('product_code')->nullable();
            $table->string('dis_name')->nullable();
            $table->string('dis_id')->nullable();
            $table->string('location_id')->nullable();
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
        Schema::dropIfExists('disserials');
    }
};
