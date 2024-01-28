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
            [
                'elder_id' => 4,
                'volunteer_id' => 2,
                'month' => 1,
                'year' => 2567,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'elder_id' => 5,
                'volunteer_id' => 3,
                'month' => 1,
                'year' => 2567,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'elder_id' => 6,
                'volunteer_id' => 2,
                'month' => 1,
                'year' => 2567,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
