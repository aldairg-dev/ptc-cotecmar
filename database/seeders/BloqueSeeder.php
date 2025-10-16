<?php

namespace Database\Seeders;

use App\Models\Bloque;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BloqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bloques = [
            // Bloques para Fragata F-100 (proyecto_id: 1)
            [
                'nombre' => 'Casco Principal',
                'descripcion' => 'Estructura principal del casco de la fragata',
                'codigo' => 'FRAG-001-B001',
                'proyecto_id' => 1,
                'estado' => 'activo'
            ],
            [
                'nombre' => 'Superestructura',
                'descripcion' => 'Estructura superior de la fragata',
                'codigo' => 'FRAG-001-B002',
                'proyecto_id' => 1,
                'estado' => 'activo'
            ],
            [
                'nombre' => 'Sala de Máquinas',
                'descripcion' => 'Compartimento de motores y sistemas de propulsión',
                'codigo' => 'FRAG-001-B003',
                'proyecto_id' => 1,
                'estado' => 'activo'
            ],

            // Bloques para Corbeta (proyecto_id: 2)
            [
                'nombre' => 'Puente de Mando',
                'descripcion' => 'Modernización del puente de mando',
                'codigo' => 'CORB-002-B001',
                'proyecto_id' => 2,
                'estado' => 'activo'
            ],
            [
                'nombre' => 'Sistema de Armas',
                'descripcion' => 'Actualización del sistema de armamento',
                'codigo' => 'CORB-002-B002',
                'proyecto_id' => 2,
                'estado' => 'activo'
            ],

            // Bloques para Patrullera (proyecto_id: 3)
            [
                'nombre' => 'Casco Liviano',
                'descripcion' => 'Casco especial para navegación fluvial',
                'codigo' => 'PAT-003-B001',
                'proyecto_id' => 3,
                'estado' => 'activo'
            ],
            [
                'nombre' => 'Sistema de Navegación',
                'descripcion' => 'Equipos de navegación para ríos',
                'codigo' => 'PAT-003-B002',
                'proyecto_id' => 3,
                'estado' => 'activo'
            ]
        ];

        foreach ($bloques as $bloque) {
            Bloque::create($bloque);
        }
    }
}
