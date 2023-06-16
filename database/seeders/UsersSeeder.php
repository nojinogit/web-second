<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $param = [
        'id' => '1',
        'name' => 'スズキフミヤ',
        'email' => 'nojinonoue@yahoo.co.jp',
        'email_verified_at' => now(),
        'password' => '123456789',
        'role' => '100',
        'created_at' => now(),
    ];DB::table('users')->insert($param);

    $param = [
        'id' => '2',
        'name' => 'a',
        'email' => 'a@a',
        'email_verified_at' => now(),
        'password' => '123456789',
        'role' => '10',
        'created_at' => now(),
    ];DB::table('users')->insert($param);
    }

}
