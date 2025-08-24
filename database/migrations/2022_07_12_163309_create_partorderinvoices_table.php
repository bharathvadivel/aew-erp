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
        Schema::create('partorderinvoices', function (Blueprint $table) {
            $table->id();
            $table->string('partorder_id')->nullable();
            $table->string('call_id');
            $table->string('invoice_no');
            $table->string('enquirylist_id')->nullable();
            $table->string('service_type');
            $table->string('service_id')->nullable();
            $table->string('service_center_name')->nullable();
            $table->string('service_center_phone')->nullable();
            $table->string('service_center_address')->nullable();
            $table->string('service_center_city')->nullable();
            $table->string('service_center_district')->nullable();
            $table->string('service_center_state')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_phone')->nullable();
            $table->string('model_no');
            $table->string('serial_no');
            $table->string('part_code');
            $table->string('part_name');
              $table->float('price');
            $table->float('gst');
            $table->integer('qty');
            $table->float('subtotal');
            $table->float('total');
            $table->string('part_category')->nullable();
            $table->string('part_status')->nullable();
            $table->string('warranty_type')->nullable();
            $table->string('customerinvoice_no')->nullable();
            $table->string('created_by')->nullable();
            $table->longText('remarks')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('partorderinvoices');
    }
};
