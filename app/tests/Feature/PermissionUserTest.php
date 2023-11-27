<?php


namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Permission;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckPermission;
use App\Http\Controllers\PostController;
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
    public function test_polices()
    {
        $user = User::factory()->createOne();

        $post = $user->posts()->save(Post::factory()->make());

        $user2 = User::factory()->createOne();
        $this->actingAs($user2)
            ->delete(route('posts_destroy' , $post))
            ->assertForbidden();
    }
    public function test_list_of_permision_be_cached(){
        Permission::create(['permission' => 'edit-articles']);
        $fromCache = Cache::get('permissions_cache');

        $this->assertCount(1 , $fromCache);

    }
}