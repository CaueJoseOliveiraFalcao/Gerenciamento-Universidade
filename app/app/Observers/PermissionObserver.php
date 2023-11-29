<?php

namespace App\Observers;
use Illuminate\Support\Facades\Cache;
use App\Models\Permission;
class PermissionObserver
{
    /**
     * Handle the Permission "created" event.
     */
    public function created(Permission $permission): void
    {
        Cache::forget('permissions');
        Cache::rememberForever('permissions_cache', fn () => Permission::all());
    }
    /**
     * Handle the Permission "updated" event.
     */
    public function updated(Permission $permission): void
    {
        //
    }

    /**
     * Handle the Permission "deleted" event.
     */
    public function deleted(Permission $permission): void
    {
        //
    }

    /**
     * Handle the Permission "restored" event.
     */
    public function restored(Permission $permission): void
    {
        //
    }

    /**
     * Handle the Permission "force deleted" event.
     */
    public function forceDeleted(Permission $permission): void
    {
        //
    }
}
