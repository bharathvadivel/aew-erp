<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transferseriallists', function (Blueprint $table) {
            $table->id();
            $table->string('transfer_no');
            $table->string('transferserial_id')->nullable();
            $table->string('from_warehouse_id')->nullable();
            $table->string('to_warehouse_id')->nullable();
            $table->string('serial_no');
            $table->date('dom')->nullable();
            $table->string('status')->default('transfered');
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
        Schema::dropIfExists('transferseriallists');
    }
};
