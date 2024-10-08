<?php

namespace Database\Seeders;

use App\Models\LeaveType;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeaveTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LeaveType::create(['name' => 'Annual Leave', 'default_days' => 12]);
        LeaveType::create(['name' => 'Sick Leave', 'default_days' => 12]);
        LeaveType::create(['name' => 'Maternity Leave', 'default_days' => 90]);
        LeaveType::create(['name' => 'Paternity Leave', 'default_days' => 12]);
    }
}
