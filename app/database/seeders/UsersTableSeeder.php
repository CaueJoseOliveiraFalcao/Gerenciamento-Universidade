<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Permission;
use App\Models\User;
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
        $idUsgGroup = Group::where('name', 'usg')->first()->id;
        $adminName = 'caue';
        $adminEmail = 'cauejoseof@gmail.com';
        $adminPassword = Hash::make('C4u3j0s3');
        $user = User::create([
            'name' => $adminName,
            'email' => $adminEmail,
            'password' => $adminPassword,
            'group_id' => $idUsgGroup
        ]);

        $user->group()->associate('usg');
        $user->givePermissionTo('admin');

        $password = Hash::make('C4u3j0s3');

        for($i = 0; $i <= 50 ; $i++){
            $name = Str::random(12);
            $email = Str::random(8) . '@example.com';
            

            $user = User::create ([
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'group_id' => $idUsgGroup
            ]);
            $user->assingToGroup('usg');
            $user->givePermissionTo('usp');
        }



    }
}
