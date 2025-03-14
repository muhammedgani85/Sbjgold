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
        Schema::create('loan_releases', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('customer_id');
          $table->string('loan_number');
          $table->decimal('amount', 15, 2);
          $table->decimal('interest', 5, 2);
          $table->decimal('waive_off', 15, 2)->nullable();
          $table->unsignedBigInteger('released_by');
          $table->date('release_date');
          $table->string('revoke_reason')->nullable();
          $table->string('revoke_by')->nullable();
          $table->string('revoke_remarks')->nullable();
          $table->timestamps();
          $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_releases');
    }
};
