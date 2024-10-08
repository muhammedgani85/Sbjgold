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
        Schema::create('loan_interest_payments', function (Blueprint $table) {
          $table->id();

          $table->string('loan_id')->nullable();
          $table->integer('month'); // Month number (1 = January, etc.)
          $table->decimal('interest_amount', 8, 2);
          $table->string('payment_method');
          $table->string('user_id')->nullable();

          $table->timestamps();

          // Define the foreign key constraints
          //$table->foreign('loan_id')->references('id')->on('loans')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_interest_payments');
    }
};
