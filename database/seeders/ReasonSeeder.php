<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class ReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      DB::table('telecaller_reasons')->insert([
        ['name' => 'Customer Follow-Up'],
        ['name' => 'Payment Reminder'],
        ['name' => 'Documentation Issue'],
        ['name' => 'Other'],
    ]);

    }
}
