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
      Schema::create('telecaller_follow', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('customer_id'); // or any other identifier
        $table->string('reason');
        $table->text('comments')->nullable();
        $table->date('follow_date');
        $table->string('loan_number');
        $table->timestamps();

        $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('telecaller_follow');
    }
};
