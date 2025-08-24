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
        Schema::create('apiorderlists', function (Blueprint $table) {
            $table->id();
            $table->string('apiorder_id');
            $table->string('order_id');
            $table->string('product_id');
            $table->string('category_name');
            $table->string('description');
            $table->string('model_no');
            $table->string('qty');
            $table->string('purchase_qty');
            $table->string('price');
            $table->string('basic_allowance');
            $table->string('sta');
            $table->string('total');
            $table->float('sub_total')->nullable();
            $table->float('grand_total')->nullable();
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
        Schema::dropIfExists('apiorderlists');
    }
};
