<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;

    // protected $primaryKey = "ass_id";

    protected $fillable = [
        'ass_id',
        'elder_id',
        'assessor_id',
        'month',
        'year',
        'ass_personal',
        'ass_part1',
        'ass_part2',
        'ass_part3',
        'ass_part4',
        'ass_part5',
        'ass_part6',
        'ass_part7',
        'ass_part8',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
