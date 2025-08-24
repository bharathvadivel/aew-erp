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
        Schema::create('deaserials', function (Blueprint $table) {
            $table->id();
            $table->string('deainvoices_id');
            $table->string('customerinvoice_no');
            $table->string('serial_no')->nullable();
             $table->string('gategory')->nullable();
            $table->string('description')->nullable();
            $table->string('model_no')->nullable();
            $table->string('product_code')->nullable();
            $table->string('customer_name')->nullable();
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
        Schema::dropIfExists('deaserials');
    }
};
