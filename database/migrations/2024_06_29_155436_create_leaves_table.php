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
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('users');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['Applied', 'Approved', 'Cancelled', 'Withdrawn', 'Pending'])->default('Pending');
            $table->integer('approved_by')->nullable();
            $table->integer('reason')->nullable();
            $table->string('remarks')->nullable();
            $table->integer('leave_type')->nullable();
            $table->integer('location')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaves');
    }
};
