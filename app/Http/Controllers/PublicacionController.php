<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicacionController extends Controller
{
    private function getPublicaciones(Request $request)
    {
        return $request->session()->get('publicaciones', [
            1 => [
                'id' => 1,
                'titulo' => 'Bicicleta de montaña',
                'descripcion' => 'Rodada 26, en buen estado.',
                'tipo' => 'Venta',
                'precio' => 1500.00,
                'estado_articulo' => 'Usado'
            ],
            2 => [
                'id' => 2,
                'titulo' => 'Colección de libros',
                'descripcion' => '10 libros de literatura variada.',
                'tipo' => 'Donacion',
                'precio' => 0,
                'estado_articulo' => 'Bueno'
            ]
        ]);
    }

    public function index(Request $request)
    {
        $publicaciones = $this->getPublicaciones($request);
        return view('publicaciones.index', compact('publicaciones'));
    }

    public function create()
    {
        return view('publicaciones.create');
    }

    public function store(Request $request)
    {
        $publicaciones = $this->getPublicaciones($request);
        $id = count($publicaciones) > 0 ? max(array_keys($publicaciones)) + 1 : 1;

        $nueva = [
            'id' => $id,
            'titulo' => $request->input('titulo'),
            'descripcion' => $request->input('descripcion'),
            'tipo' => $request->input('tipo'),
            'precio' => $request->input('precio', 0),
            'estado_articulo' => $request->input('estado_articulo'),
        ];

        $publicaciones[$id] = $nueva;
        $request->session()->put('publicaciones', $publicaciones);

        return redirect()->route('publicaciones.index')->with('success', 'Publicación creada en sesión correctamente.');
    }

    public function show(Request $request, $id)
    {
        $publicaciones = $this->getPublicaciones($request);
        $publicacion = $publicaciones[$id] ?? null;

        if (!$publicacion) {
            return redirect()->route('publicaciones.index');
        }

        return view('publicaciones.show', compact('publicacion'));
    }

    public function edit(Request $request, $id)
    {
        $publicaciones = $this->getPublicaciones($request);
        $publicacion = $publicaciones[$id] ?? null;

        if (!$publicacion) {
            return redirect()->route('publicaciones.index');
        }

        return view('publicaciones.edit', compact('publicacion'));
    }

    public function update(Request $request, $id)
    {
        $publicaciones = $this->getPublicaciones($request);

        if (isset($publicaciones[$id])) {
            $publicaciones[$id] = [
                'id' => $id,
                'titulo' => $request->input('titulo'),
                'descripcion' => $request->input('descripcion'),
                'tipo' => $request->input('tipo'),
                'precio' => $request->input('precio', 0),
                'estado_articulo' => $request->input('estado_articulo'),
            ];
            $request->session()->put('publicaciones', $publicaciones);
        }

        return redirect()->route('publicaciones.index')->with('success', 'Publicación actualizada en sesión.');
    }

    public function destroy(Request $request, $id)
    {
        $publicaciones = $this->getPublicaciones($request);
        unset($publicaciones[$id]);
        $request->session()->put('publicaciones', $publicaciones);

        return redirect()->route('publicaciones.index')->with('success', 'Publicación eliminada de la sesión.');
    }
}