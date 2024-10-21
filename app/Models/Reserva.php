<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reserva extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'estado',
        'identificador',
        'fecha_entrada',
        'fecha_salida',
        'habitacione_id',
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function habitacione(): BelongsTo
    {
        return $this->belongsTo(Habitacione::class);
    }
}
