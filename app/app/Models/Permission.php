<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Permission extends Model
{
    use HasFactory;

    protected $guarded = [];

    public static function getPermission(string $permission): Permission
    {
        return self::getAllCache()->where("permission" , $permission)->first();

    }
    public static function getAllCache(): Collection{

        /** @var Collection $permissions */
        $permission = Cache::rememberForever('permissions', function () {
            return self::all();
        });

        return $permission;
    }
    public static function existsOnCache(string $permission): bool{

        return self::getAllCache()->where('permission' , $permission)->isNotEmpty();
    }
}
