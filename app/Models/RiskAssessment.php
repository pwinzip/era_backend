<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiskAssessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'ass_id',
        'part',
        'subpart',
        'touch',
        'violent',
        'manage',
        'note',
    ];

    protected $casts = ['manage' => 'array'];
}
