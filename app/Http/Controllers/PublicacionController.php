<?php

namespace App\Http\Controllers;

use App\Models\Publicacion;
use Illuminate\Http\Request;

class PublicacionController extends Controller
{
    public function index()
    {
        $publicaciones = Publicacion::latest()->get();
        return view('publicaciones.index', compact('publicaciones'));
    }

    public function create()
    {
        return view('publicaciones.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'tipo' => 'required|in:Donacion,Venta',
            'precio' => 'nullable|numeric|min:0',
            'estado_articulo' => 'required|string|max:100',
        ]);

        Publicacion::create($request->all());

        return redirect()->route('publicaciones.index')->with('success', 'Publicación creada exitosamente.');
    }

    public function show(Publicacion $publicacion)
    {
        return view('publicaciones.show', compact('publicacion'));
    }

    public function edit(Publicacion $publicacion)
    {
        return view('publicaciones.edit', compact('publicacion'));
    }

    public function update(Request $request, Publicacion $publicacion)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'tipo' => 'required|in:Donacion,Venta',
            'precio' => 'nullable|numeric|min:0',
            'estado_articulo' => 'required|string|max:100',
        ]);

        $publicacion->update($request->all());

        return redirect()->route('publicaciones.index')->with('success', 'Publicación actualizada exitosamente.');
    }

    public function destroy(Publicacion $publicacion)
    {
        $publicacion->delete();

        return redirect()->route('publicaciones.index')->with('success', 'Publicación eliminada exitosamente.');
    }
}