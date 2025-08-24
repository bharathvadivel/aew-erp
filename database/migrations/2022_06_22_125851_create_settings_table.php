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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('assign_template_id');
            $table->string('complete_template_id');
            $table->string('sms_auth_key');
            $table->string('retry');
            $table->string('tcs');
            $table->string('tcs_range');
            $table->string('map_id');
            $table->string('app_version');
            $table->string('status')->default('Enable');
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
        Schema::dropIfExists('settings');
    }
};
