<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'prefix' => 'นาย',
                'name' => 'admin1',
                'username' => 'admin1',
                'password' => Hash::make('212224236'),
                'user_type' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'prefix' => 'นาย',
                'name' => 'test-vol1',
                'username' => 'testvol1',
                'password' => Hash::make('123456'),
                'user_type' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'prefix' => 'นาย',
                'name' => 'test-vol2',
                'username' => 'testvol2',
                'password' => Hash::make('123456'),
                'user_type' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
