<?php

namespace Database\Seeders;

use App\Models\Department;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \App\Models\Department::truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
//        Departments::truncate();
        $departments = [
            ['name' => 'Finance'],
            ['name' => 'Political & Cabinet'],
            ['name' => 'Planning & Programme Implementation'],
            ['name' => 'General Administration Department'],
            ['name' => 'Secretariat Administration Department'],
            ['name' => 'Vigilance Department'],
            ['name' => 'Public Works Department'],
            ['name' => 'Horticulture Department'],
            ['name' => 'Public Health Engineering Department'],
            ['name' => 'Urban Development & Poverty Alleviation Department'],
            ['name' => 'Animal Husbandry & Veterinary'],
            ['name' => 'Personnel & Administrative Reforms'],
            ['name' => 'Health & Family Welfare'],
            ['name' => 'Higher & Technical Education'],
            ['name' => 'Commerce & Industry'],
            ['name' => 'Home'],
            ['name' => 'Taxation'],
            ['name' => 'Disaster Management & Rehabilitation'],
            ['name' => 'Power & Electricity'],
            ['name' => 'Arts & Culture'],
            ['name' => 'Land Resources, Soil & Water Conservation'],
            ['name' => 'District Council & Minority Affairs'],
            ['name' => 'Agriculture Dept.'],
            ['name' => 'Irrigation & Water Resources'],
            ['name' => 'Co-operation Department'],
            ['name' => 'Food, Civil Supplies & Consumer Affairs'],
            ['name' => 'LAD'],
            ['name' => 'Fisheries'],
            ['name' => 'School Education'],
            ['name' => 'Labour, Employment, Skill Development & Entrepreneurship '],
            ['name' => 'Printing & Stationery Department'],
            ['name' => 'Rural Development'],
            ['name' => 'Information & Public Relation'],
            ['name' => 'Land Revenue & Settlement Department'],
            ['name' => 'Social Welfare'],
            ['name' => 'Excise & Narcotics'],
            ['name' => 'Sericulture department'],
            ['name' => 'Law & Judicial, Parliamentary Affairs'],
            ['name' => 'Transport'],
            ['name' => 'Environment, Forest & Climate Change Department'],
            ['name' => 'Sports & Youth Services'],
            ['name' => 'Tourism'],
            ['name' => 'Information & Communication Technology'],

            // foransics@empex.com

        ];
        foreach ($departments as $department) {
            Department::create($department);
        }
    }
}
