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
      Schema::create('employee_salaries', function (Blueprint $table) {
        $table->id();
        $table->date('salary_month'); // Store salary month as a date (you can choose a specific format in your views)
        $table->unsignedBigInteger('added_by');
        $table->string('employee_id')->nullable();
        $table->string('description');
        $table->decimal('amount', 10, 2); // decimal for monetary values
        $table->string('location')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_salaries');
    }
};
