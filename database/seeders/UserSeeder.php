<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User seeder
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123456'),
                'role' => 'admin'
            ], [
                'name' => 'user',
                'email' => 'user@gmail.com',
                'password' => bcrypt('123456'),
                'role' => 'user'
            ], [
                'name' => 'user1',
                'email' => 'user1@gmail.com',
                'password' => bcrypt('123456'),
                'role' => 'user'
            ], [
                'name' => 'user2',
                'email' => 'user2@gmail.com',
                'password' => bcrypt('123456'),
                'role' => 'user'
            ], [
                'name' => 'user3',
                'email' => 'user3@gmail.com',
                'password' => bcrypt('123456'),
                'role' => 'user'
            ], [
                'name' => 'user4',
                'email' => 'user4@gmail.com',
                'password' => bcrypt('123456'),
                'role' => 'user'
            ], [
                'name' => 'user5',
                'email' => 'user5@gmail.com',
                'password' => bcrypt('123456'),
                'role' => 'user'
            ], [
                'name' => 'user6',
                'email' => 'user6@gmail.com',
                'password' => bcrypt('123456'),
                'role' => 'user'
            ], [
                'name' => 'user7',
                'email' => 'user7@gmail.com',
                'password' => bcrypt('123456'),
                'role' => 'user'
            ], [
                'name' => 'user8',
                'email' => 'user8@gmail.com',
                'password' => bcrypt('123456'),
                'role' => 'user'
            ], [
                'name' => 'user9',
                'email' => 'user9@gmail.com',
                'password' => bcrypt('123456'),
                'role' => 'user'
            ], [
                'name' => 'user10',
                'email' => 'user10@gmail.com',
                'password' => bcrypt('123456'),
                'role' => 'user'
            ], [
                'name' => 'user11',
                'email' => 'user11@gmail.com',
                'password' => bcrypt('123456'),
                'role' => 'user'
            ]

        ]);
    }
}
