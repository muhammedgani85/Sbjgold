<?php

namespace Database\Seeders;

use App\Models\PublicHoliday;
use Carbon\Carbon;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PublicHolidaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $holidays = [
            ['date' => '2024-01-01', 'name' => 'New Year\'s Day'],
            ['date' => '2024-04-21', 'name' => 'Easter Sunday'],
            ['date' => '2024-05-01', 'name' => 'Labor Day'],
            // Add more holidays here
        ];

        foreach ($holidays as $holiday) {
            PublicHoliday::create([
                'date' => Carbon::parse($holiday['date']),
                'name' => $holiday['name'],
            ]);
        }
    }
}
