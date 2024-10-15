<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Habitacione extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'identificador',
        'piso',
        'tipo',
        'disponibilidad',
        'numPersonas',
        'precio',
        'sede_id'
        ];

    protected $hidden = ['sede_id'];

    public function sede(): BelongsTo
    {
        return $this->belongsTo(Sede::class);
    }
}
