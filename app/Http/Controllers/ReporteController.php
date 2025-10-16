<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\Pieza;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReporteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Reporte de piezas pendientes agrupadas por proyectos
     */
    public function piezasPendientes()
    {
        $proyectos = Proyecto::with([
            'bloques.piezas' => function ($query) {
                $query->where('estado', 'Pendiente');
            }
        ])->get();

        // Filtrar proyectos que tienen piezas pendientes
        $proyectosConPendientes = $proyectos->filter(function ($proyecto) {
            return $proyecto->bloques->some(function ($bloque) {
                return $bloque->piezas->count() > 0;
            });
        });

        return Inertia::render('Reportes/PiezasPendientes', [
            'proyectos' => $proyectosConPendientes
        ]);
    }

    /**
     * Reporte gráfico por proyecto de piezas pendientes y fabricadas
     */
    public function graficoProyectos()
    {
        $proyectos = Proyecto::with('bloques.piezas')->get();

        $datosGrafico = $proyectos->map(function ($proyecto) {
            $totalPiezas = $proyecto->bloques->sum(function ($bloque) {
                return $bloque->piezas->count();
            });

            $piezasPendientes = $proyecto->bloques->sum(function ($bloque) {
                return $bloque->piezas->where('estado', 'Pendiente')->count();
            });

            $piezasFabricadas = $proyecto->bloques->sum(function ($bloque) {
                return $bloque->piezas->where('estado', 'Fabricado')->count();
            });

            return [
                'proyecto' => $proyecto->nombre,
                'codigo' => $proyecto->codigo,
                'total' => $totalPiezas,
                'pendientes' => $piezasPendientes,
                'fabricadas' => $piezasFabricadas,
                'porcentaje_completado' => $totalPiezas > 0 ? round(($piezasFabricadas / $totalPiezas) * 100, 2) : 0
            ];
        });

        return Inertia::render('Reportes/GraficoProyectos', [
            'datosGrafico' => $datosGrafico
        ]);
    }

    /**
     * API para obtener datos de gráfico
     */
    public function apiGraficoProyectos()
    {
        $proyectos = Proyecto::with('bloques.piezas')->get();

        $datosGrafico = $proyectos->map(function ($proyecto) {
            $totalPiezas = $proyecto->bloques->sum(function ($bloque) {
                return $bloque->piezas->count();
            });

            $piezasPendientes = $proyecto->bloques->sum(function ($bloque) {
                return $bloque->piezas->where('estado', 'Pendiente')->count();
            });

            $piezasFabricadas = $proyecto->bloques->sum(function ($bloque) {
                return $bloque->piezas->where('estado', 'Fabricado')->count();
            });

            return [
                'proyecto' => $proyecto->nombre,
                'codigo' => $proyecto->codigo,
                'total' => $totalPiezas,
                'pendientes' => $piezasPendientes,
                'fabricadas' => $piezasFabricadas,
                'porcentaje_completado' => $totalPiezas > 0 ? round(($piezasFabricadas / $totalPiezas) * 100, 2) : 0
            ];
        });

        return response()->json($datosGrafico);
    }
}
