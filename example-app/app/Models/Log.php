<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'data',
        'entrada',
        'final_almoco', // inicio_almoco removido daqui
        'saida',
        'total_horas',
        'obs',
    ];

    protected $casts = [
        'data' => 'date',
        'entrada' => 'datetime',
        'final_almoco' => 'datetime',
        'saida' => 'datetime',
    ];

    // Relação: Log pertence a User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}