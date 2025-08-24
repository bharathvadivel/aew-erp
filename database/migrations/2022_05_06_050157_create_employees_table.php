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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('emp_id');
            $table->string('name');
            $table->string('a_name')->nullable();
            $table->string('a_phone')->nullable();
            $table->string('phone');
            $table->string('password');
            $table->longText('address');
            $table->date('dob');
            $table->string('email')->nullable();
            $table->string('e_phone')->nullable();
            $table->string('bank');
            $table->string('account_no');
            $table->string('ifsc_code');
            $table->string('branch');
            $table->string('passport_no')->nullable();
            $table->date('doj');
            $table->string('blood_group');
            $table->string('aadhar_no');
            $table->string('photo')->nullable();
            $table->string('aadhar')->nullable();
            $table->string('license')->nullable();
            $table->string('education')->nullable();
            $table->string('employee_type');
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
        Schema::dropIfExists('employees');
    }
};
