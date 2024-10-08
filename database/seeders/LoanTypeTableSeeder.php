<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoanTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('loan_types')->insert([
            [
                'loan_type' => 'Gold Loan',
                'loan_prefix' => 'GL',
                'status' => 'Active',

            ], [
                'loan_type' => 'Personal Loan',
                'loan_prefix' => 'PL',
                'status' => 'Active',

            ], [
                'loan_type' => 'Vechile Loan',
                'loan_prefix' => 'VL',
                'status' => 'Active',

            ], [
                'loan_type' => 'Agricultural Loan',
                'loan_prefix' => 'AL',
                'status' => 'Active',

            ]
        ]);
    }
}
