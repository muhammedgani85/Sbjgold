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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('initial');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('father_name');
            $table->string('phone_number');
            $table->string('emergency_number');
            $table->string('city');
            $table->text('address');
            $table->string('aadhar_number');
            $table->string('driving_license_number')->nullable();
            $table->string('pan');
            $table->decimal('salary', 8, 2);
            $table->decimal('deduction', 8, 2);
            $table->decimal('others', 8, 2);
            $table->string('role');
            $table->string('user_name');
            $table->string('password');
            $table->text('description')->nullable();;
            $table->string('document')->nullable();
            $table->enum('status', ['Active', 'InActive', 'Resigned', 'Abscond'])->default('Active');
            $table->integer('location')->nullable();
            $table->string('emp_id')->nullable();
            $table->string('created_by')->nullable();
            $table->date('joining_date')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
