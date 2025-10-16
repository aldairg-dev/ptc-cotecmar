<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Proyecto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'codigo',
        'fecha_inicio',
        'fecha_fin',
        'estado'
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
    ];

    public function bloques(): HasMany
    {
        return $this->hasMany(Bloque::class);
    }

    public function registrosMinucia(): HasMany
    {
        return $this->hasMany(RegistroMinucia::class);
    }
}
