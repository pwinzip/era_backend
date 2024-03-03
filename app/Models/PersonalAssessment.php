<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalAssessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'ass_id',
        'gender',
        'age',
        'weight',
        'height',
        'career',
        'income',
        'high_education',
        'marital_status',
        'house_member',
        'children',
        'year_working',
        'period_working',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = ['career' => 'array'];
}
