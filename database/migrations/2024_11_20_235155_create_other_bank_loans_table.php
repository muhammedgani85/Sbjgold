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
        Schema::create('other_bank_loans', function (Blueprint $table) {
            $table->id();
            $table->string('customer_number')->nullable();
            $table->string('customer_loan_no');
            $table->string('bank_loan_number');
            $table->integer('bank_id');
            $table->string('interest_rate');
            $table->float('loan_amount',8,2);
            $table->string('added_by');
            $table->date('loan_date');
            $table->string('jewel_net_weight')->nullable();
            $table->string('jewel_loan_weight')->nullable();
            $table->enum('stone_is_available',['No','Yes'])->default('No');
            $table->float('additional_charges',8,2)->nullable();
            $table->float('document_charges',8,2)->nullable();
            $table->string('jewel_photo')->nullable();
            $table->string('customer_photo')->nullable();
            $table->string('customer_other')->nullable();
            $table->integer('tenurity')->nullable();
            $table->enum('status',['Active','Released','Action'])->default('Active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('other_bank_loans');
    }
};
