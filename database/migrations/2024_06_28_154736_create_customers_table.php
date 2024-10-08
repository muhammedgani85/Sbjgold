<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id')->unique();
            $table->string('initial', 2);
            $table->string('first_name');
            $table->string('last_name');
            $table->string('father_name')->nullable();
            $table->string('spouse_name')->nullable();
            $table->string('gender');
            $table->date('dob');
            $table->string('marital_status');
            $table->string('phone_number', 13);
            $table->string('emergency_number', 13);
            $table->string('email_id')->nullable();
            $table->string('city');
            $table->text('permanent_address');
            $table->text('communication_address');
            $table->string('ward')->nullable();
            $table->string('aadhar_number', 16)->unique();
            $table->string('driving_license_number')->nullable();
            $table->string('pan')->nullable();
            $table->foreignId('occupation_id')->constrained('occupation_models');
            $table->string('occupation_type');
            $table->string('job_type_details')->nullable();
            $table->string('r_name')->nullable();
            $table->string('r_phone')->nullable();
            $table->text('r_address')->nullable();
            $table->string('r_name1')->nullable();
            $table->string('r_phone1')->nullable();
            $table->text('r2_address')->nullable();
            $table->text('r_others')->nullable();
            $table->string('customer_photo')->nullable();
            $table->string('customer_aadharr')->nullable();
            $table->string('customer_other')->nullable();
            $table->string('account_holder_name')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('ifsc')->nullable();
            $table->string('gpay_no')->nullable();
            $table->foreignId('location_id')->constrained('branches');
            $table->enum('status', ['Active', 'InActive'])->default('Active');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
