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
        Schema::create('loan_actions', function (Blueprint $table) {
          Schema::create('loan_actions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('loan_id'); // Foreign key for the loan
            $table->unsignedBigInteger('customer_id'); // Foreign key for the customer
            $table->string('action_type'); // Type of action (e.g., "created", "updated", etc.)
            $table->unsignedBigInteger('send_by'); // User ID who performed the action
            $table->timestamps(); // Includes created_at and updated_at
            $table->softDeletes(); // Includes deleted_at for soft deletes

            // Foreign key constraints
            $table->foreign('loan_id')->references('id')->on('loans')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('send_by')->references('id')->on('users')->onDelete('set null');
        });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_actions');
    }
};
