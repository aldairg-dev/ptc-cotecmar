<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\Bloque;
use App\Models\Pieza;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MinuciaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return Inertia::render('Minucia/Dashboard', [
            'proyectos' => Proyecto::with(['bloques.piezas'])->get(),
            'estadisticas' => [
                'total_proyectos' => Proyecto::count(),
                'total_piezas' => Pieza::count(),
                'piezas_pendientes' => Pieza::where('estado', 'Pendiente')->count(),
                'piezas_fabricadas' => Pieza::where('estado', 'Fabricado')->count(),
                'registros_hoy' => Pieza::whereDate('fecha_registro', today())->whereNotNull('fecha_registro')->count()
            ]
        ]);
    }

    public function create()
    {
        return Inertia::render('Minucia/FormularioRegistro', [
            'proyectos' => Proyecto::where('estado', 'activo')->get(),
            'bloques' => [],
            'piezas' => []
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'proyecto_id' => 'required|exists:proyectos,id',
            'bloque_id' => 'required|exists:bloques,id',
            'pieza_id' => 'required|exists:piezas,id',
            'peso_real' => 'required|numeric|min:0',
            'observaciones' => 'nullable|string|max:1000'
        ]);
        $pieza = Pieza::findOrFail($request->pieza_id);

        if ($pieza->estado !== 'Pendiente') {
            return redirect()->back()
                ->withErrors(['pieza_id' => 'Solo se pueden registrar piezas en estado Pendiente'])
                ->withInput();
        }

        $pieza->update([
            'peso_real' => $request->peso_real,
            'estado' => 'Fabricado',
            'fecha_registro' => now(),
            'user_id' => Auth::id()
        ]);

        return redirect()->route('minucia.create')->with('success', 'Pieza registrada exitosamente. Estado actualizado a Fabricado.');
    }


    public function registros()
    {
        $registros = Pieza::with(['proyecto', 'bloque', 'user'])
            ->whereNotNull('fecha_registro')
            ->where('estado', 'Fabricado')
            ->orderBy('fecha_registro', 'desc')
            ->paginate(15);

        return Inertia::render('Minucia/ListadoRegistros', [
            'registros' => $registros
        ]);
    }


    public function show($id)
    {
        $registro = Pieza::with(['proyecto', 'bloque', 'user'])
            ->where('id', $id)
            ->whereNotNull('fecha_registro')
            ->firstOrFail();

        return Inertia::render('Minucia/VerRegistro', [
            'registro' => $registro
        ]);
    }


    public function edit($id)
    {
        $registro = Pieza::with(['proyecto', 'bloque'])
            ->where('id', $id)
            ->whereNotNull('fecha_registro')
            ->firstOrFail();

        return Inertia::render('Minucia/EditarRegistro', [
            'registro' => $registro,
            'proyectos' => Proyecto::where('estado', 'activo')->get(),
            'bloques' => Bloque::where('proyecto_id', $registro->proyecto_id)->where('estado', 'activo')->get(),
            'piezas' => Pieza::where('bloque_id', $registro->bloque_id)->get()
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'peso_real' => 'required|numeric|min:0',
            'observaciones' => 'nullable|string|max:1000'
        ]);

        $pieza = Pieza::where('id', $id)
            ->whereNotNull('fecha_registro')
            ->firstOrFail();

        $pieza->update([
            'peso_real' => $request->peso_real,
        ]);

        return redirect()->route('minucia.listado')->with('success', 'Peso real actualizado exitosamente');
    }


    public function destroy($id)
    {
        $pieza = Pieza::where('id', $id)
            ->whereNotNull('fecha_registro')
            ->firstOrFail();

        $pieza->update([
            'peso_real' => null,
            'fecha_registro' => null,
            'user_id' => null,
            'estado' => 'Pendiente'
        ]);

        return redirect()->route('minucia.listado')->with('success', 'Registro eliminado. Pieza devuelta a estado Pendiente.');
    }
}
