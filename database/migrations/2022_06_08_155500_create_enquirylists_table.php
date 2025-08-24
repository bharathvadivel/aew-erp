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
        Schema::create('enquirylists', function (Blueprint $table) {
            $table->id();
            $table->string('call_id');
            $table->string('enquiry_id');
            $table->string('service_type');
            $table->string('service_id')->nullable();
            $table->string('service_center_name')->nullable();
            $table->string('executive_id')->nullable();
            $table->string('executive_name')->nullable();
            $table->string('partner_id')->nullable();
            $table->string('partner_name')->nullable();
            $table->date('date_of_purchase');
            $table->string('invoice_no')->nullable();
            $table->string('customer_name');
            $table->string('model_no');
            $table->string('serial_no')->nullable();
            $table->string('punch_location')->nullable();
            $table->string('part_code')->nullable();
            $table->string('part_name')->nullable();
            $table->string('remarks')->nullable();
            $table->string('status');
            $table->date('end_date');
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
        Schema::dropIfExists('enquirylists');
    }
};
