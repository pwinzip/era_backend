<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Elder extends Model
{
    use HasFactory;

    protected $fillable = [
        'prefix',
        'name',
        'code_name',
        'house_no',
        'moo',
        'tambon',
        'amphoe',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function assessment()
    {
        return $this->hasMany(Elder::class, 'elder_id', 'user_id');
    }
}
