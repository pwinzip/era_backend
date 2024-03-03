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
                'manage' => json_encode([false, false, true, true, false]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'ass_id' => 1,
                'part' => 1,
                'subpart' => "1.2",
                'touch' => 1,
                'violent' => 2,
                'manage' => json_encode([false, false, true, true, false]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'ass_id' => 1,
                'part' => 1,
                'subpart' => "1.3",
                'touch' => 2,
                'violent' => 3,
                'manage' => json_encode([true, false, true, true, false]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'ass_id' => 1,
                'part' => 1,
                'subpart' => "1.4",
                'touch' => 2,
                'violent' => 3,
                'manage' => json_encode([false, false, false, false, false]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'ass_id' => 1,
                'part' => 1,
                'subpart' => "1.5",
                'touch' => 2,
                'violent' => 3,
                'manage' => json_encode([false, false, false, true, false]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'ass_id' => 1,
                'part' => 1,
                'subpart' => "1.6",
                'touch' => 2,
                'violent' => 3,
                'manage' => json_encode([false, false, false, false, false]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
