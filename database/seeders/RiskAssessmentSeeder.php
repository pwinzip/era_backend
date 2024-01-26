<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RiskAssessmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('risk_assessments')->insert([
            [
                'ass_id' => 1,
                'part' => 1,
                'subpart' => "1.1",
                'touch' => 1,
                'violent' => 1,
                'manage' => json_encode([3, 4]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'ass_id' => 1,
                'part' => 1,
                'subpart' => "1.2",
                'touch' => 1,
                'violent' => 2,
                'manage' => json_encode([1, 3, 4]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'ass_id' => 1,
                'part' => 1,
                'subpart' => "1.3",
                'touch' => 2,
                'violent' => 3,
                'manage' => json_encode([1, 4, 5]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'ass_id' => 1,
                'part' => 2,
                'subpart' => "2.1",
                'touch' => 1,
                'violent' => 1,
                'manage' => json_encode([1, 2, 3, 5]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
