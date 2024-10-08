<?php

namespace Database\Seeders;

use App\Models\LeaveReason;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeaveReasonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LeaveReason::create(['reason' => 'Vacation']);
        LeaveReason::create(['reason' => 'Medical']);
        LeaveReason::create(['reason' => 'Family Emergency']);
        LeaveReason::create(['reason' => 'Personal']);
        LeaveReason::create(['reason' => 'Others']);
    }
}
