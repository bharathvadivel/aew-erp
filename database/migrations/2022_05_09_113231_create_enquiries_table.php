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
        Schema::create('enquiries', function (Blueprint $table) {
            $table->id();
            $table->string('call_id');
            $table->string('service_type');
            $table->string('service_id');
            $table->string('service_center_name');
            $table->string('brand_name');
            $table->string('gategory_name');
            $table->string('model_no');
            $table->string('description');
            $table->string('product_code')->nullable();
            $table->string('serial_no')->nullable();
            $table->string('warranty_type')->nullable();
            $table->longText('customer_remarks')->nullable();
            $table->string('partner_id')->nullable();
            $table->string('partner_name')->nullable();
            $table->string('partner_phone')->nullable();
            $table->string('store_name')->nullable();
            $table->string('invoice_no')->nullable();
            $table->date('date_of_purchase');
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('alter_phone')->nullable();
            $table->longText('customer_address');
            $table->string('lat');
            $table->string('lang');
            $table->string('customer_state');
            $table->string('customer_district');
            $table->string('customer_city');
            $table->string('customer_area');
            $table->string('customer_pincode');
            $table->string('created_by')->nullable();
            $table->string('executive_id')->nullable();
            $table->string('executive_name')->nullable();
            $table->date('end_date');
            $table->dateTime('finish_date')->nullable();
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('enquiries');
    }
};
