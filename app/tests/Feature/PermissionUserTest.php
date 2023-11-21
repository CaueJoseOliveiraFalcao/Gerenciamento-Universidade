<?php


namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class PermissionUserTest extends TestCase
{
    public function testIsGivePermission()
    {
        // Arrange
        /** @var User $user */
        $user = User::factory()->createOne();

        // Act
        $user->givePermissionTo('edit-articles');

        // Assert
        $this->assertTrue($user->hasPermissionTo('edit-articles'));
        $this->assertDatabaseHas('permissions', [
            'permission' => 'edit-articles',
        ]);
    }
}