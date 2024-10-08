<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\SubMenus;

class SubMenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubMenus::create([
            'menu_id' => 1,
            'url' => 'loans',
            'name' => 'Dashboard',
            'slug' => 'ui-accordion-dashboard'
        ]);

        SubMenus::create([
            'menu_id' => 1,
            'url' => 'ui/accordion',
            'name' => 'New Loan',
            'slug' => 'ui-accordion-new-loan'
        ]);

        SubMenus::create([
            'menu_id' => 1,
            'url' => 'ui/alerts',
            'name' => 'Loan Interest',
            'slug' => 'ui-alerts-loan-interest'
        ]);

        SubMenus::create([
            'menu_id' => 1,
            'url' => 'ui/alerts',
            'name' => 'Loan Closing',
            'slug' => 'ui-alerts-loan-closing'
        ]);

        SubMenus::create([
            'menu_id' => 1,
            'url' => 'ui/alerts',
            'name' => 'Loan Renewal',
            'slug' => 'ui-alerts-loan-renewal'
        ]);

        SubMenus::create([
            'menu_id' => 1,
            'url' => 'ui/alerts',
            'name' => 'Loan Outstanding',
            'slug' => 'ui-alerts-loan-outstanding'
        ]);
    }
}
