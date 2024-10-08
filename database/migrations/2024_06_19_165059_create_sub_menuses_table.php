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
        Schema::create('sub_menuses', function (Blueprint $table) {
            $table->id();
            $table->string('url')->nullable();
            $table->string('name');
            $table->string('slug')->unique();
            $table->enum('status', ['Active', 'InActive'])->default('Active');
            $table->foreignId('menu_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_menuses');
    }
};
