<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrancheTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('branches')->insert([
            [
                'branch_name' => 'Cumbum',
                'branch_prefix' => 'CBM',
                'status' => 'Active',

            ], [
                'branch_name' => 'Gudalor',
                'branch_prefix' => 'GDL',
                'status' => 'Active',

            ], [
                'branch_name' => 'Theni',
                'branch_prefix' => 'TH',
                'status' => 'Active',

            ]
        ]);
    }
}
