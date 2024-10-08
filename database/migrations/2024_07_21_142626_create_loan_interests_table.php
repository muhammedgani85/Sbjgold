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

      Schema::create('loan_interests', function (Blueprint $table) {
        $table->id();
        $table->string('type')->comment('Type of loan interest, e.g., personal loan, home loan, etc.');
        $table->decimal('interest_rate', 5, 2)->comment('Interest rate for the loan');
        $table->decimal('interest_percentage', 5, 2)->comment('Interest interest for the loan');
        $table->decimal('per_gram_amount', 5, 2)->comment('Interest interest for the loan Amount');
        $table->integer('months')->comment('Duration in months (3, 6, 9, 12)');
        $table->boolean('status')->default(true)->comment('Status of the loan interest (active or not)');
        $table->integer('document_charge')->nullable();
        $table->foreignId('loan_type_id')->constrained()->onDelete('cascade');
        $table->timestamps();
    });




    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_interests');
    }
};
