<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubicacione extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'pais',
        'estado',
        'municipio',
        'direccion',
        'sede_id'
    ];

    public function sede()
    {
        return $this->belongsTo(Sede::class);
    }
}
