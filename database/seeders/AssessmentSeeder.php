<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssessmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('assessments')->insert([
            // [
            //     'elder_id' => 4,
            //     'assessor_id' => 2,
            //     'month' => 2,
            //     'year' => 2567,
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now(),
            // ],
            [
                'elder_id' => 1,
                'assessor_id' => 3,
                'month' => 2,
                'year' => 2567,
                'ass_personal' => 1,
                'ass_part1' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
