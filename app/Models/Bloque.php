<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bloque extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'codigo',
        'proyecto_id',
        'estado'
    ];

    public function proyecto(): BelongsTo
    {
        return $this->belongsTo(Proyecto::class);
    }

    public function piezas(): HasMany
    {
        return $this->hasMany(Pieza::class);
    }

    public function registrosMinucia(): HasMany
    {
        return $this->hasMany(RegistroMinucia::class);
    }
}
