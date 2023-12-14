<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'moo',
        'tambon',
        'amphoe',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'remember_token',
    ];
}
