<?php

namespace Database\Seeders;
use App\Models\Group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Groups extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultGroups = ['UEA' , 'usg' , 'UFAM'];
        foreach ($defaultGroups as $groupName){
            $group = new Group();
            $group->createGroup($groupName);
        }
    }
}