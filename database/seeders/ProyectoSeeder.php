<?php

namespace Database\Seeders;

use App\Models\Proyecto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProyectoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $proyectos = [
            [
                'nombre' => 'Construcción Fragata F-100',
                'descripcion' => 'Proyecto de construcción de fragata clase F-100 para la Armada Nacional',
                'codigo' => 'FRAG-001',
                'fecha_inicio' => '2025-01-01',
                'fecha_fin' => '2025-12-31',
                'estado' => 'activo'
            ],
            [
                'nombre' => 'Modernización Corbeta Almirante Padilla',
                'descripcion' => 'Modernización y actualización de sistemas de la corbeta',
                'codigo' => 'CORB-002',
                'fecha_inicio' => '2025-03-01',
                'fecha_fin' => '2025-09-30',
                'estado' => 'activo'
            ],
            [
                'nombre' => 'Construcción Patrullera de Rio',
                'descripcion' => 'Proyecto de construcción de patrullera para operaciones fluviales',
                'codigo' => 'PAT-003',
                'fecha_inicio' => '2025-02-15',
                'fecha_fin' => '2025-08-15',
                'estado' => 'activo'
            ]
        ];

        foreach ($proyectos as $proyecto) {
            Proyecto::create($proyecto);
        }
    }
}
