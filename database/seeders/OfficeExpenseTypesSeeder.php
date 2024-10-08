<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OfficeExpenseType;

class OfficeExpenseTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $expenseTypes = [
            ['name' => 'Utilities', 'description' => 'Expenses for utilities like electricity, water, and gas.'],
            ['name' => 'Electricity', 'description' => 'Expenses for utilities like electricity, water, and gas.'],
            ['name' => 'Water', 'description' => 'Expenses for utilities like electricity, water, and gas.'],
            ['name' => 'Flower', 'description' => 'Expenses for utilities like electricity, water, and gas.'],
            ['name' => 'Donation', 'description' => 'Expenses for utilities like electricity, water, and gas.'],
            ['name' => 'Salary', 'description' => 'Expenses for utilities like electricity, water, and gas.'],
            ['name' => 'Stationery', 'description' => 'Expenses for office supplies and stationery items.'],
            ['name' => 'Travel', 'description' => 'Expenses related to business travel and transportation.'],
            ['name' => 'Meals and Entertainment', 'description' => 'Expenses for meals and entertainment for business purposes.'],
            ['name' => 'Rent', 'description' => 'Expenses for office rent.'],
            ['name' => 'Maintenance', 'description' => 'Expenses for office maintenance and repairs.'],
            ['name' => 'Software', 'description' => 'Expenses for software purchases and subscriptions.'],
        ];

        foreach ($expenseTypes as $type) {
            OfficeExpenseType::create($type);
        }
    }
}
