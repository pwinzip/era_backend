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
                'prefix' => 'นาย',
                'name' => 'test-eld01',
                'code_name' => 'elder001',
                'house_no' => '999/99',
                'moo' => 1,
                'tambon' => "บ้านพร้าว",
                'amphoe' => "ป่าพะยอม",
                // 'volunteer_id' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'prefix' => 'นาย',
                'name' => 'test-eld02',
                'code_name' => 'elder002',
                'house_no' => '111/11',
                'moo' => 2,
                'tambon' => "ลานข่อย",
                'amphoe' => "ป่าพะยอม",
                // 'volunteer_id' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'prefix' => 'นาง',
                'name' => 'test-eld03',
                'code_name' => 'elder003',
                'house_no' => '222/22',
                'moo' => 2,
                'tambon' => "ลานข่อย",
                'amphoe' => "ป่าพะยอม",
                // 'volunteer_id' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
