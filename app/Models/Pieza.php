<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pieza extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'codigo',
        'idpieza',
        'pieza',
        'bloque_id',
        'proyecto_id',
        'peso_teorico',
        'peso_real',
        'material',
        'estado',
        'fecha_registro',
        'user_id'
    ];

    protected $casts = [
        'peso_teorico' => 'decimal:3',
        'peso_real' => 'decimal:3',
        'fecha_registro' => 'datetime',
    ];

    public function bloque(): BelongsTo
    {
        return $this->belongsTo(Bloque::class);
    }

    public function proyecto(): BelongsTo
    {
        return $this->belongsTo(Proyecto::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
