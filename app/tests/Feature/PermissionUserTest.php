<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
class PermissionUserTest extends TestCase
{
    public function isGivePermission()
    {
        /**@var User $user */
        
        $user = User::factory()->createOne();

        $user->givePermissionTo("Admin");

        $this->assertTrue($user->hasPermissionTo("Admin"));
        $this->assertDatabese('permission' , [
            'permission' => 'Admin'
        ])
    }
    
}
