<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reporte;
use App\Models\Publicacion;

class ReporteController extends Controller
{
    // Mostrar formulario para reportar una publicación (Parte A)
    public function create($publicacion_id)
    {
        $publicacion = Publicacion::findOrFail($publicacion_id);
        return view('reportes.create', compact('publicacion'));
    }

    // Guardar el reporte en la BD (Parte A)
    public function store(Request $request)
    {
        $request->validate([
            'publicacion_id' => 'required|exists:publicacions,id',
            'motivo' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:1000',
        ]);

        Reporte::create([
            'publicacion_id' => $request->publicacion_id,
            'user_id' => auth()->id(),
            'motivo' => $request->motivo,
            'descripcion' => $request->descripcion,
        ]);

        return redirect('/')->with('success', 'Reporte enviado con éxito. El equipo de moderación lo revisará.');
    }

    // Panel de administración para ver reportes pendientes (Parte B)
    public function admin()
    {
        $reportes = Reporte::with(['publicacion', 'user'])
            ->where('estado', 'pendiente')
            ->latest()
            ->get();

        return view('reportes.admin', compact('reportes'));
    }

    // Dar de baja la publicación reportada y marcar reporte como revisado (Parte B)
    public function resolver($id)
    {
        $reporte = Reporte::findOrFail($id);

        if ($reporte->publicacion) {
            $reporte->publicacion->delete();
        }

        $reporte->estado = 'revisado';
        $reporte->save();

        return back()->with('success', 'Publicación dada de baja y reporte atendido.');
    }

    // Descartar reporte sin borrar la publicación (Parte B)
    public function descartar($id)
    {
        $reporte = Reporte::findOrFail($id);
        $reporte->estado = 'revisado';
        $reporte->save();

        return back()->with('success', 'Reporte descartado; la publicación permanece activa.');
    }
}
