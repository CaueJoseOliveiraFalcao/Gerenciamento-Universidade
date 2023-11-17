<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    use HasFactory;

    protected $fillable = [
        'idusuario',
        'name',
        'isAdmin',
        'abilities',
        'last_used_at',
        'expires_at',
        'token'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'idusuario', 'id');
    }
}
