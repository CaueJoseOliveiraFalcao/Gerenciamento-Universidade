<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = [];
        $password = Hash::make('C4u3j0s3');

        for($i = 0; $i <= 50 ; $i++){
            $name = Str::random(12);
            $email = Str::random(8) . '@example.com';
            
            $values = [
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'group_id' => 7
            ];


            
        DB::table('users')->insert($values);
        }



    }
}
