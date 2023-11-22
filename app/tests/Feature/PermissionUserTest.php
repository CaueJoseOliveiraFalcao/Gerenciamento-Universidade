<?php


namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Route;

class PermissionUserTest extends TestCase
{
    public function test_is_give_permission()
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
    public function test_router_middware()
    {
        Route::get('url-test' , function () {
            return 'test';
        })->middleware('permission:edit-articles');

        /** @var User $user */
        $user = User::factory()->createOne();
        
        $this->actingAs($user)
            ->get('url-test')
            ->assertForbidden();

        $user->givePermissionTo('edit-articles');
        
        $this->actingAs($user)
            ->get('url-test')
            ->assertSuccessful();
    }
}