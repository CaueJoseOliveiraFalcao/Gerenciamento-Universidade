<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('C4u3j0s3');

        $users = [
            [
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'password' => $password,
            ],
            [
                'name' => 'Jane Doe',
                'email' => 'jane.doe@example.com',
                'password' => $password,
            ],
            [
                'name' => 'Bob Smith',
                'email' => 'bob.smith@example.com',
                'password' => $password,
            ],
            [
                'name' => 'Alice Johnson',
                'email' => 'alice.johnson@example.com',
                'password' => $password,
            ],
            [
                'name' => 'Charlie Brown',
                'email' => 'charlie.brown@example.com',
                'password' => $password,
            ],
            [
                'name' => 'David White',
                'email' => 'david.white@example.com',
                'password' => $password,
            ],
            [
                'name' => 'Eva Green',
                'email' => 'eva.green@example.com',
                'password' => $password,
            ],
            [
                'name' => 'Frank Miller',
                'email' => 'frank.miller@example.com',
                'password' => $password,
            ],
            [
                'name' => 'Grace Taylor',
                'email' => 'grace.taylor@example.com',
                'password' => $password,
            ],
            [
                'name' => 'Harry Davis',
                'email' => 'harry.davis@example.com',
                'password' => $password,
            ],
        ];

        DB::table('users')->insert($users);


    }
}
