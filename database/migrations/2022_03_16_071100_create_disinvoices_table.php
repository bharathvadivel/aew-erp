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
        Schema::create('disinvoices', function (Blueprint $table) {
            $table->id();
            $table->string('disinvoice_no');
            $table->string('dis_id')->nullable();
            $table->string('dis_name');
            $table->string('by_order_no')->nullable();
            $table->string('date')->nullable();
            $table->string('ew_bill_no')->nullable();
            $table->string('others')->nullable();
            $table->string('gst');
            $table->string('hsn_code');
            $table->string('gstin_no')->nullable();
            $table->string('gategory');
            $table->string('description');
            $table->string('model_no');
            $table->integer('qty');
            $table->integer('stock');
            $table->integer('price');
            $table->integer('billing_price');
            $table->float('basic_allowance',15,2);
            $table->integer('sta');
            $table->float('partner_allowance',15,2);
            $table->integer('additional_discount');
            $table->float('total',15,2);
            $table->float('sub_total',15,2)->nullable();
$table->float('taxable_value', 15, 5)->nullable();
            $table->float('tcs_val', 15, 5)->nullable();
            $table->float('round_off',15,5)->nullable();
            $table->float('grand_total',15,2)->nullable();
            $table->string('credit_days')->nullable();
            $table->string('credit_limit')->nullable();
            $table->string('available_limit')->nullable();
            $table->string('partner_type');
            $table->string('address')->nullable();
            $table->string('pincode')->nullable();
            $table->string('city')->nullable();
            $table->string('district')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('location_id')->nullable();
            $table->string('created_by');
            $table->string('from_address')->nullable();
            $table->string('from_location_id')->nullable();
            $table->string('delivery_location_id')->nullable();
            $table->string('delivery_address')->nullable();
            $table->string('ch_box_status')->nullable();
            $table->float('tcs',15,1);
            $table->string('login_id')->nullable();
            $table->string('order_id')->nullable();
            $table->string('order_by')->nullable();
            $table->string('status')->default('Pending');
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
        Schema::dropIfExists('disinvoices');
    }
};
