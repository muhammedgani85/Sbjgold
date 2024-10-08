<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'role_name' => 'Branch Manager',
                'status' => 'Active',

            ],
            [
                'role_name' => 'Gold Appraiser',
                'status' => 'Active',

            ],
            [
                'role_name' => 'Loan Officer',
                'status' => 'Active',

            ],
            [
                'role_name' => 'Customer Relationship Executive',
                'status' => 'Active',

            ],
            [
                'role_name' => 'Collections Officer',
                'status' => 'Active',

            ],
            [
                'role_name' => 'Marketing Manager',
                'status' => 'Active',

            ],
            [
                'role_name' => 'Operations Supervisor',
                'status' => 'Active',

            ],
            [
                'role_name' => 'Finance Manager',
                'status' => 'Active',

            ],
            [
                'role_name' => 'CEO',
                'status' => 'Active',

            ],
            [
                'role_name' => 'Administrator',
                'status' => 'Active',

            ]

        ]);
    }
}
