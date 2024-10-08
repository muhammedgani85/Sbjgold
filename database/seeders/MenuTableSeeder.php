<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('menus')->insert([
            [
                'url' => '/',
                'name' => 'Dashboards',
                'icon' => 'menu-icon tf-icons bx bx-home-circle',
                'slug' => 'dashboard',
                'status' => 'Active',

            ],
            [

                'url' => '/',
                'name' => 'Employee',
                'icon' => 'menu-icon tf-icons bx bx-home-circle',
                'slug' => 'Expenses Management',
                'status' => 'Active',

            ],
            [

                'url' => '/',
                'name' => 'Expenses Management',
                'icon' => 'menu-icon tf-icons bx bx-home-circle',
                'slug' => 'Expenses Management',
                'status' => 'Active',

            ],
            [

                'url' => '/',
                'name' => 'Customer Management',
                'icon' => 'menu-icon tf-icons bx bx-home-circle',
                'slug' => 'Expenses Management',
                'status' => 'Active',

            ],
            [

                'url' => '/',
                'name' => 'Loan Management',
                'icon' => 'menu-icon tf-icons bx bx-home-circle',
                'slug' => 'Loan Management',
                'status' => 'Active',

            ],
            [
                'url' => '/',
                'name' => 'Reports',
                'icon' => 'menu-icon tf-icons bx bx-home-circle',
                'slug' => 'Reports',
                'status' => 'Active',

            ],

            [

                'url' => '/',
                'name' => 'Analytics',
                'icon' => 'menu-icon tf-icons bx bx-home-circle',
                'slug' => 'Analytics',
                'status' => 'Active',

            ],
            [

                'url' => '/',
                'name' => 'TeleCaller',
                'icon' => 'menu-icon tf-icons bx bx-home-circle',
                'slug' => 'TeleCaller',
                'status' => 'Active',

            ],
            [

                'url' => '/',
                'name' => 'Roles',
                'icon' => 'menu-icon tf-icons bx bx-home-circle',
                'slug' => 'Roles',
                'status' => 'Active',

            ]

        ]);
    }
}
