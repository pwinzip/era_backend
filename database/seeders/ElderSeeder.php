<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ElderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('elders')->insert([
            [
                'user_id' => 3,
                'house_no' => '999/99',
                'moo' => 2,
                'tambon' => "บ้านพร้าว",
                'amphoe' => "ป่าพะยอม",
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
