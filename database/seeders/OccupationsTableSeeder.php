<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OccupationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $occupations = [
            'Agriculture',
            'Fisheries',
            'Handicrafts',
            'Textiles',
            'Artisans',
            'Information Technology',
            'Manufacturing',
            'Healthcare',
            'Education',
            'Construction',
            'Banking and Finance',
            'Retail',
            'Tourism and Hospitality',
            'Transportation',
            'Media and Entertainment',
            'Renewable Energy',
            'E-commerce',
            'Startup Business',
            'Dairy Farming',
            'Poultry Farming',
            'Horticulture',
            'Tamil Nadu Civil Services (TNCS)',
            'Tamil Nadu Administrative Service (TNAS)',
            'Tamil Nadu State Secretariat Service',
            'Police Services',
            'Tamil Nadu Police Service',
            'Sub-Inspector of Police',
            'Constable',
            'Educational Services',
            'Professors and Lecturers',
            'School Teachers',
            'Educational Officers',
            'Health Services',
            'Doctors',
            'Nurses',
            'Pharmacists',
            'Lab Technicians',
            'Engineering Services',
            'Civil Engineers',
            'Electrical Engineers',
            'Mechanical Engineers',
            'Judicial Services',
            'District Judges',
            'Magistrates',
            'Public Prosecutors',
            'Revenue Services',
            'Revenue Officers',
            'Tahsildars',
            'Village Administrative Officers (VAOs)',
            'Agricultural Services',
            'Agricultural Officers',
            'Horticultural Officers',
            'Fisheries Officers',
            'Social Services',
            'Social Welfare Officers',
            'Child Development Project Officers',
            'Finance and Accounting Services',
            'Accounts Officers',
            'Auditors',
            'Tax Officers',
            'Clerical Services',
            'Clerks',
            'Typists',
            'Stenographers',
            'Public Works and Infrastructure',
            'Public Works Department Engineers',
            'Surveyors',
            'Draftsmen',
            'Transport Services',
            'Transport Officers',
            'Road Transport Corporation (RTC) Officers',
            'Environmental Services',
            'Forest Officers',
            'Environmental Engineers',
            'Communication and Information Technology',
            'IT Officers',
            'System Administrators',
            'Libraries and Archives',
            'Librarians',
            'Archivists',
            'Administrative Support',
            'Office Assistants',
            'Peons',
            'Public Relations and Media',
            'Public Relations Officers',
            'Information Officers',
            'Research and Development',
            'Scientists',
            'Research Officers',
            'Arts and Culture',
            'Cultural Officers',
            'Museum Curators',
            'Daily Wages'
        ];

        foreach ($occupations as $occupation) {
            DB::table('occupation_models')->insert([
                'occupation' => $occupation,
                'status' => 'Active',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
