<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $fillable = [
        'description',
        'leave_date',
        'is_approved',
    ];

    protected $casts = [
        'leave_date' => 'date',
        'is_approved' => 'boolean',
    ];
}
