<?php

namespace Database\Seeders;

use App\Models\RegistroMinucia;
use App\Models\Pieza;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegistroMinuciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usuario = User::first();
        $piezaFabricada = Pieza::where('estado', 'fabricada')->first();

        if ($piezaFabricada && $usuario) {
            // Crear algunos registros de ejemplo
            RegistroMinucia::create([
                'proyecto_id' => $piezaFabricada->bloque->proyecto_id,
                'bloque_id' => $piezaFabricada->bloque_id,
                'pieza_id' => $piezaFabricada->id,
                'user_id' => $usuario->id,
                'peso_real' => 1205.600,
                'diferencia_peso' => 1205.600 - $piezaFabricada->peso_teorico,
                'fecha_registro' => Carbon::now()->subDays(2),
                'observaciones' => 'Registro de prueba - pieza dentro de tolerancias'
            ]);
        }

        // Crear algunos registros adicionales con diferentes piezas
        $piezasPendientes = Pieza::where('estado', 'pendiente')->limit(3)->get();

        foreach ($piezasPendientes as $index => $pieza) {
            // Simular peso real con pequeñas variaciones
            $variacion = rand(-50, 50) / 10; // Variación de -5 a +5 kg
            $pesoReal = $pieza->peso_teorico + $variacion;

            RegistroMinucia::create([
                'proyecto_id' => $pieza->bloque->proyecto_id,
                'bloque_id' => $pieza->bloque_id,
                'pieza_id' => $pieza->id,
                'user_id' => $usuario->id,
                'peso_real' => $pesoReal,
                'diferencia_peso' => $pesoReal - $pieza->peso_teorico,
                'fecha_registro' => Carbon::now()->subDays($index + 1),
                'observaciones' => 'Registro de ejemplo #' . ($index + 1)
            ]);

            // Actualizar estado de la pieza a fabricada
            $pieza->update(['estado' => 'fabricada']);
        }
    }
}
