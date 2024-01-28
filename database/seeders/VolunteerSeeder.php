<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VolunteerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('volunteers')->insert([
            [
                'user_id' => 2,
                'moo' => 1,
                'tambon' => "บ้านพร้าว",
                'amphoe' => "ป่าพะยอม",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 3,
                'moo' => 2,
                'tambon' => "ลานข่อย",
                'amphoe' => "ป่าพะยอม",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
