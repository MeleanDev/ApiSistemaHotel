<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Sede extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'nombre'
    ];

    public function ubicacione(): HasOne
    {
        return $this->hasOne(Ubicacione::class);
    }

    public function habitacione(): HasMany
    {
        return $this->hasMany(Habitacione::class);
    }

    public function user(): HasMany
    {
        return $this->hasMany(user::class);
    }
}
