<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Proyecto;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    public function index()
    {
        $proyectos = Proyecto::with(['bloques.piezas'])->get();
        return response()->json($proyectos);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'codigo' => 'required|string|unique:proyectos,codigo',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'estado' => 'in:activo,inactivo,completado'
        ]);

        $proyecto = Proyecto::create($request->all());
        return response()->json($proyecto, 201);
    }

    public function show(string $id)
    {
        $proyecto = Proyecto::with(['bloques.piezas', 'registrosMinucia'])->findOrFail($id);
        return response()->json($proyecto);
    }

    public function update(Request $request, string $id)
    {
        $proyecto = Proyecto::findOrFail($id);
        
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'codigo' => 'required|string|unique:proyectos,codigo,' . $id,
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'estado' => 'in:activo,inactivo,completado'
        ]);

        $proyecto->update($request->all());
        return response()->json($proyecto);
    }

    public function destroy(string $id)
    {
        $proyecto = Proyecto::findOrFail($id);
        $proyecto->delete();
        return response()->json(['message' => 'Proyecto eliminado exitosamente']);
    }
}