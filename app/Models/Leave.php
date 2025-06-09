<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Leave extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'leave_date',
        'status',
    ];

    protected $casts = [
        'leave_date' => 'date:Y-m-d',      
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
