<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('partner_id');
            $table->string('partner_type');
            $table->string('name');
            $table->string('place')->nullable();
            $table->time('in_time')->nullable();
            $table->time('out_time')->nullable();
            $table->time('working_time')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('attendances');
    }
};
