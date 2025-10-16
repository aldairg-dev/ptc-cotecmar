<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Bloque;
use Illuminate\Http\Request;

class BloqueController extends Controller
{
    /**
     * Obtener bloques por proyecto
     */
    public function byProyecto($proyectoId)
    {
        $bloques = Bloque::where('proyecto_id', $proyectoId)
            ->where('estado', 'activo')
            ->get();

        return response()->json($bloques);
    }

    public function index()
    {
        $bloques = Bloque::with('proyecto')->get();
        return response()->json($bloques);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'codigo' => 'required|string|unique:bloques,codigo',
            'proyecto_id' => 'required|exists:proyectos,id',
            'estado' => 'in:activo,inactivo,completado'
        ]);

        $bloque = Bloque::create($request->all());
        return response()->json($bloque->load('proyecto'), 201);
    }

    public function show(string $id)
    {
        $bloque = Bloque::with(['proyecto', 'piezas'])->findOrFail($id);
        return response()->json($bloque);
    }

    public function update(Request $request, string $id)
    {
        $bloque = Bloque::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'codigo' => 'required|string|unique:bloques,codigo,' . $id,
            'proyecto_id' => 'required|exists:proyectos,id',
            'estado' => 'in:activo,inactivo,completado'
        ]);

        $bloque->update($request->all());
        return response()->json($bloque->load('proyecto'));
    }

    public function destroy(string $id)
    {
        $bloque = Bloque::findOrFail($id);
        $bloque->delete();
        return response()->json(['message' => 'Bloque eliminado exitosamente']);
    }
}
