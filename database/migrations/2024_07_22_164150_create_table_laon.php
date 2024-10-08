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
      Schema::create('loans', function (Blueprint $table) {
        $table->id();
        $table->string('loan_number')->unique();
        $table->unsignedBigInteger('customer_id');
        $table->unsignedBigInteger('location_id');
        $table->unsignedBigInteger('loan_type_id');
        $table->decimal('jewel_grams', 8, 2);
        $table->decimal('jewel_net_grams', 8, 2);
        $table->decimal('additional_cost', 15, 2)->nullable();
        $table->decimal('total_loan_amount', 15, 2)->nullable();
        $table->decimal('total_interest_amount', 15, 2)->nullable();
        $table->decimal('per_month_payable_amount', 15, 2)->nullable();
        $table->decimal('total_include_int_amount', 15, 2)->nullable();
        $table->integer('interest_type_id')->nullable();
        $table->decimal('document_charge', 15, 2)->nullable();
        $table->text('customer_photo')->nullable();
        $table->text('customer_other')->nullable();
        $table->float('interest_per')->nullable();
        $table->integer('interest_month')->nullable();
        $table->integer('pergram_amount')->nullable();
        $table->enum('status',['New','Approved','Withdraw','Rejected','Dispatch'])->default('New');
        $table->integer('added_by')->nullable();
        $table->integer('approved_by')->nullable();
        $table->timestamp('approved_date')->nullable();
        $table->integer('dispatched_by')->nullable();
        $table->timestamp('dispatched_date')->nullable();
        $table->timestamps();
        $table->softDeletes();
        $table->foreign('customer_id')->references('id')->on('customers');
        $table->foreign('location_id')->references('id')->on('branches');
        $table->foreign('loan_type_id')->references('id')->on('loan_types');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      Schema::dropIfExists('loans');
    }
};
