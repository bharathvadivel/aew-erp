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
        Schema::create('warlogics', function (Blueprint $table) {
            $table->id();
            $table->string('model_no');
            $table->string('product_category');
            $table->float('standard_warranty',8,2);
            $table->float('extended_warranty',8,2);
            $table->string('part1');
            $table->float('part1_warranty',8,2);
            $table->string('part2');
            $table->float('part2_warranty',8,2);
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
        Schema::dropIfExists('warlogics');
    }
};
