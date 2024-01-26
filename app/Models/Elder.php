<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Elder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address',
        'moo',
        'tambon',
        'amphoe',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'remember_token',
    ];

    public function assessment()
    {
        return $this->hasMany(Elder::class, 'elder_id', 'user_id');
    }
}
