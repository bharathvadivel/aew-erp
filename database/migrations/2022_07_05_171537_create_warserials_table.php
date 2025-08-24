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
        Schema::create('warserials', function (Blueprint $table) {
            $table->id();
            $table->string('serial_no')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_phone')->nullable();
            $table->string('gategory')->nullable();
            $table->string('model_no')->nullable();
            $table->date('dom')->nullable();
            $table->date('date_of_purchase')->nullable();
            $table->float('standard_warranty')->nullable();
            $table->float('extended_warranty')->nullable();
            $table->string('part1')->nullable();
            $table->float('part1_warranty')->nullable();
            $table->string('part2')->nullable();
            $table->float('part2_warranty')->nullable();
            $table->date('standard_warranty_exp_date')->nullable();
            $table->date('extended_warranty_exp_date')->nullable();
            $table->date('part1_warranty_exp_date')->nullable();
            $table->date('part2_warranty_exp_date')->nullable();
            $table->string('proof')->nullable();
            $table->longText('remarks')->nullable();
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
        Schema::dropIfExists('warserials');
    }
};
