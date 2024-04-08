<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
class Permission extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'permissions';

    public static function getPermission(string $permission): Permission
    {
        Log::info('Buscando permissão no Cache : '.$permission);
        $p =  self::getAllCache()->where("permission", $permission)->first();
    
        if (!$p){
            Log::info('Não Encontrada no Cache : '.$permission);
            $p = Permission::query()->create(['permission' => $permission]);
            if ($p) {
                Log::info('Permissão criada: '.$permission);
            } else {
                Log::info('Falha ao criar permissão: '.$permission);
            }
        } else {
            Log::info('Permissão encontrada no cache: '.$permission);
        }
    
        return $p;
    }
    public static function getAllCache(): Collection{

        /** @var Collection $permissions */
        $permissions = Cache::rememberForever('permissions', function () {
            return self::all();
        });

        return $permissions;
    }
    public static function existsOnCache(string $permission): bool{

        return self::getAllCache()->where('permission' , $permission)->isNotEmpty();
    }
}
