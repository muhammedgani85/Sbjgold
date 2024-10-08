<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('loan_interests', function (Blueprint $table) {
            $table->string('loan_type')->after('status'); // Assuming 'status' is the last column
        });
    }

    public function down()
    {
        Schema::table('loan_interests', function (Blueprint $table) {
            $table->dropColumn('loan_type');
        });
    }
};
