<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PersonalAssessmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('personal_assessments')->insert([
            [
                'ass_id' => 1,
                'age' => 65,
                'weight' => 45,
                'height' => 165,
                'career' => json_encode([1, 2, 7, 14, 15]),
                'income' => 2,
                'high_education' => 2,
                'marital_status' => 2,
                'house_member' => 5,
                'children' => 2,
                'year_working' => 10,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
