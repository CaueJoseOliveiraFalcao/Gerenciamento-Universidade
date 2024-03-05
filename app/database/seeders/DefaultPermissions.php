<?php

namespace Database\Seeders;
use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DefaultPermissions extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultPermissions = ['admin' , 'coordinator' , 'teacher' , 'student' , 'usp'];
        foreach ($defaultPermissions as $permision){
            Permission::getPermission($permision);
        }
    }
}
