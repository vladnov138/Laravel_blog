<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => "groupddos",
            'email' => 'test@test.com',
            'password' => bcrypt('password'),
            'role_id' => 1,
            'deleted_at' => '2023-12-01 13:50:58',
            'updated_at' => '2023-12-01 13:46:01',
            'created_at' => '2023-12-01 13:50:58'
        ]);
        DB::table('users')->insert([
            'name' => "testuser",
            'email' => 'test123@test.com',
            'password' => bcrypt('password'),
            'role_id' => 1,
            'updated_at' => '2023-12-01 13:46:01',
            'created_at' => '2023-12-01 13:50:58'
        ]);
        DB::table('users')->insert([
            'name' => "admin",
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'role_id' => 3,
            'updated_at' => '2023-12-01 13:46:01',
            'created_at' => '2023-12-01 13:50:58'
        ]);
    }
}
