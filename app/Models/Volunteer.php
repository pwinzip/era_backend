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
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function assessment()
    {
        return $this->hasMany(Assessment::class, 'volunteer_id', 'user_id');
    }
}
