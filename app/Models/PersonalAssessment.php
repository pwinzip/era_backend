<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalAssessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'ass_id',
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
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'remember_token',
    ];
}
