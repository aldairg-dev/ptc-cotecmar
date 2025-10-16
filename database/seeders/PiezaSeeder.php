<?php

namespace Database\Seeders;

use App\Models\Pieza;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PiezaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $piezas = [
            // Piezas para Proyecto FRAG (Fragata) - Bloque Casco Principal (bloque_id: 1, proyecto_id: 1)
            [
                'nombre' => 'Plancha de Acero Principal',
                'descripcion' => 'Plancha principal del casco de 12mm',
                'codigo' => 'FRAG-001-B001-P001',
                'idpieza' => '001',
                'pieza' => 'B01',
                'bloque_id' => 1,
                'proyecto_id' => 1,
                'peso_teorico' => 2500.450,
                'material' => 'Acero Naval',
                'estado' => 'Pendiente'
            ],
            [
                'nombre' => 'Refuerzo Longitudinal',
                'descripcion' => 'Refuerzo estructural longitudinal',
                'codigo' => 'FRAG-001-B001-P002',
                'idpieza' => '002',
                'pieza' => 'A02',
                'bloque_id' => 1,
                'proyecto_id' => 1,
                'peso_teorico' => 850.200,
                'material' => 'Acero Naval',
                'estado' => 'Pendiente'
            ],
            [
                'nombre' => 'Mamparos Transversales',
                'descripcion' => 'Mamparos de separación de compartimentos',
                'codigo' => 'FRAG-001-B001-P003',
                'idpieza' => '003',
                'pieza' => 'C03',
                'bloque_id' => 1,
                'proyecto_id' => 1,
                'peso_teorico' => 1200.750,
                'material' => 'Acero Naval',
                'estado' => 'Fabricado',
                'peso_real' => 1205.300,
                'fecha_registro' => now(),
                'user_id' => 1
            ],

            // Piezas para Superestructura (bloque_id: 2, proyecto_id: 1)
            [
                'nombre' => 'Torre de Comando',
                'descripcion' => 'Estructura de la torre de comando',
                'codigo' => 'FRAG-001-B002-P001',
                'idpieza' => '004',
                'pieza' => 'T01',
                'bloque_id' => 2,
                'proyecto_id' => 1,
                'peso_teorico' => 1800.300,
                'material' => 'Aluminio Naval',
                'estado' => 'Pendiente'
            ],
            [
                'nombre' => 'Plataforma de Observación',
                'descripcion' => 'Plataforma superior de observación',
                'codigo' => 'FRAG-001-B002-P002',
                'idpieza' => '005',
                'pieza' => 'P01',
                'bloque_id' => 2,
                'proyecto_id' => 1,
                'peso_teorico' => 650.100,
                'material' => 'Aluminio Naval',
                'estado' => 'Pendiente'
            ],

            // Piezas para Proyecto BICM (Oceanográfico) - Bloque Laboratorio (bloque_id: 3, proyecto_id: 2)
            [
                'nombre' => 'Mesa de Trabajo',
                'descripcion' => 'Mesa de trabajo para laboratorio',
                'codigo' => 'BICM-002-B003-P001',
                'idpieza' => '006',
                'pieza' => 'M01',
                'bloque_id' => 3,
                'proyecto_id' => 2,
                'peso_teorico' => 450.200,
                'material' => 'Acero Inoxidable',
                'estado' => 'Pendiente'
            ],
            [
                'nombre' => 'Sistema de Ventilación',
                'descripcion' => 'Sistema de ventilación del laboratorio',
                'codigo' => 'BICM-002-B003-P002',
                'idpieza' => '007',
                'pieza' => 'V01',
                'bloque_id' => 3,
                'proyecto_id' => 2,
                'peso_teorico' => 280.150,
                'material' => 'Aluminio',
                'estado' => 'Fabricado',
                'peso_real' => 285.400,
                'fecha_registro' => now()->subDays(2),
                'user_id' => 2
            ],

            // Piezas para Sala de Máquinas (bloque_id: 4, proyecto_id: 2)
            [
                'nombre' => 'Tanque de Combustible',
                'descripcion' => 'Tanque principal de combustible',
                'codigo' => 'BICM-002-B004-P001',
                'idpieza' => '008',
                'pieza' => 'TC01',
                'bloque_id' => 4,
                'proyecto_id' => 2,
                'peso_teorico' => 2100.500,
                'material' => 'Acero Naval',
                'estado' => 'Pendiente'
            ],

            // Piezas para Proyecto BALC - Bloque Proa (bloque_id: 5, proyecto_id: 3)
            [
                'nombre' => 'Bulbo de Proa',
                'descripcion' => 'Estructura del bulbo de proa',
                'codigo' => 'BALC-003-B005-P001',
                'idpieza' => '009',
                'pieza' => 'BP01',
                'bloque_id' => 5,
                'proyecto_id' => 3,
                'peso_teorico' => 3200.800,
                'material' => 'Acero Naval',
                'estado' => 'Pendiente'
            ],
            [
                'nombre' => 'Ancla Principal',
                'descripcion' => 'Ancla principal del buque',
                'codigo' => 'BALC-003-B005-P002',
                'idpieza' => '010',
                'pieza' => 'AN01',
                'bloque_id' => 5,
                'proyecto_id' => 3,
                'peso_teorico' => 1500.400,
                'material' => 'Acero Naval',
                'estado' => 'Pendiente'
            ],

            // Piezas para Popa (bloque_id: 6, proyecto_id: 3)
            [
                'nombre' => 'Hélice Principal',
                'descripcion' => 'Hélice de propulsión principal',
                'codigo' => 'BALC-003-B006-P001',
                'idpieza' => '011',
                'pieza' => 'H01',
                'bloque_id' => 6,
                'proyecto_id' => 3,
                'peso_teorico' => 1800.200,
                'material' => 'Bronce Naval',
                'estado' => 'Pendiente'
            ],

            // Piezas para Timón (bloque_id: 7, proyecto_id: 3)
            [
                'nombre' => 'Timón',
                'descripcion' => 'Timón de gobierno',
                'codigo' => 'BALC-003-B007-P001',
                'idpieza' => '012',
                'pieza' => 'TM01',
                'bloque_id' => 7,
                'proyecto_id' => 3,
                'peso_teorico' => 950.150,
                'material' => 'Acero Naval',
                'estado' => 'Pendiente'
            ],

            // Más piezas pendientes para demostrar funcionalidad
            [
                'nombre' => 'Sistema Eléctrico',
                'descripcion' => 'Cableado principal del buque',
                'codigo' => 'FRAG-001-B001-P004',
                'idpieza' => '013',
                'pieza' => 'E01',
                'bloque_id' => 1,
                'proyecto_id' => 1,
                'peso_teorico' => 750.300,
                'material' => 'Cobre',
                'estado' => 'Pendiente'
            ]
        ];

        foreach ($piezas as $pieza) {
            Pieza::create($pieza);
        }
    }
}
