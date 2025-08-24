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
        Schema::create('enquiryimages', function (Blueprint $table) {
            $table->id();
            $table->string('call_id');
            $table->string('enquirylist_id');
            $table->string('service_id')->nullable();
            $table->string('service_type');
            $table->string('executive_id')->nullable();
            $table->string('invoice_copy');
            $table->string('symptoms_issue');
            $table->string('back_serial');
            $table->string('panel_serial');
            $table->string('product_fit');
            $table->string('warranty_card');
            $table->string('other')->nullable();
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
        Schema::dropIfExists('enquiryimages');
    }
};
