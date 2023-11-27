<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getPermission(string $permission): Permission
    {
        /** @var Collection $permissions */
        $permission = Cache::rememberForever('permissions', function () {
            return self::all;
        });

        return $permission->where('permission' , $permission)->first();
    }
}
