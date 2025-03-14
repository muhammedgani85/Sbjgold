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
        Schema::create('funds', function (Blueprint $table) {
          $table->id();
          $table->string('location');
          $table->decimal('amount', 15, 2);
          $table->text('description')->nullable();
          $table->string('added_by');
          $table->enum('type', ['add', 'withdraw'])->default('add'); // To specify whether it's an addition or withdrawal of funds
          $table->timestamps();
          $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('funds');
    }
};
