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
        Schema::create('deainvoices', function (Blueprint $table) {
            $table->id();
            $table->string('customerinvoice_no');
            $table->string('sub_location_id');
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('date');
             $table->string('gst');
            $table->string('hsn_code');
            $table->string('gategory');
            $table->string('description');
            $table->string('model_no');
            $table->integer('qty');
            $table->integer('stock');
            $table->integer('price');
            $table->integer('billing_price');
            $table->float('total',15,2);
            $table->float('sub_total',15,2)->nullable();
            $table->float('taxable_value', 15, 5)->nullable();
            $table->float('round_off',15,5)->nullable();
            $table->float('grand_total',15,2)->nullable();
            $table->string('partner_type')->nullable();
            $table->string('address');
            $table->string('pincode');
            $table->string('area');
            $table->string('city');
            $table->string('district');
            $table->string('state');
            $table->string('created_by');
            $table->string('promoter_id')->nullable();
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
        Schema::dropIfExists('deainvoices');
    }
};
