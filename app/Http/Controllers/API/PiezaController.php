<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pieza;
use Illuminate\Http\Request;

class PiezaController extends Controller
{

    public function byBloque($bloqueId)
    {
        $piezas = Pieza::where('bloque_id', $bloqueId)
            ->where('estado', 'Pendiente')
            ->select(['id', 'nombre', 'codigo', 'idpieza', 'pieza', 'peso_teorico', 'material', 'estado'])
            ->get();

        return response()->json($piezas);
    }

    public function index()
    {
        $piezas = Pieza::with(['bloque.proyecto'])->get();
        return response()->json($piezas);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'codigo' => 'required|string|unique:piezas,codigo',
            'idpieza' => 'required|string|unique:piezas,idpieza',
            'pieza' => 'required|string',
            'bloque_id' => 'required|exists:bloques,id',
            'proyecto_id' => 'required|exists:proyectos,id',
            'peso_teorico' => 'required|numeric|min:0',
            'material' => 'nullable|string|max:255',
            'estado' => 'in:Pendiente,Fabricado,Otro'
        ]);

        $pieza = Pieza::create($request->all());
        return response()->json($pieza->load('bloque'), 201);
    }

    public function show(string $id)
    {
        $pieza = Pieza::with(['bloque.proyecto', 'user'])->findOrFail($id);
        return response()->json($pieza);
    }

    public function update(Request $request, string $id)
    {
        $pieza = Pieza::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'codigo' => 'required|string|unique:piezas,codigo,' . $id,
            'bloque_id' => 'required|exists:bloques,id',
            'peso_teorico' => 'required|numeric|min:0',
            'material' => 'nullable|string|max:255',
            'estado' => 'in:pendiente,fabricada,rechazada'
        ]);

        $pieza->update($request->all());
        return response()->json($pieza->load('bloque'));
    }

    public function destroy(string $id)
    {
        $pieza = Pieza::findOrFail($id);
        $pieza->delete();
        return response()->json(['message' => 'Pieza eliminada exitosamente']);
    }
}
