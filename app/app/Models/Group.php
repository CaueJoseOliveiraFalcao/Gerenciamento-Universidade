<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Group extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = ['name'];

    public function users(): HasMany 
    {
        return $this->hasMany(User::class);
    }
    public function createGroup(string $group): void
    {
        $istrue =  Group::where('name' , $group)->first();
        if (!$istrue){
            Group::create([
                'name' => $group,
            ]);
        }


    }
}
