<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publicacion;

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
        $datos = $request->validate([
            'titulo'          => 'required|string|max:255',
            'descripcion'     => 'required|string',
            'tipo'            => 'required|in:Donacion,Venta',
            'precio'          => 'required_if:tipo,Venta|nullable|numeric|min:0',
            'categoria'       => 'required|string|max:255',
            'estado_articulo' => 'required|string|max:255',
            'foto'            => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'titulo.required'          => 'El título es obligatorio.',
            'descripcion.required'     => 'La descripción es obligatoria.',
            'tipo.required'            => 'Elige si es donación o venta.',
            'precio.required_if'       => 'Indica el precio si es una venta.',
            'categoria.required'       => 'Elige una categoría.',
            'estado_articulo.required' => 'Elige el estado del artículo.',
            'foto.required'            => 'Sube una foto del artículo.',
            'foto.image'               => 'El archivo debe ser una imagen.',
            'foto.mimes'               => 'La foto debe ser JPG, PNG o WEBP.',
            'foto.max'                 => 'La foto no debe pesar más de 2 MB.',
        ]);

        if ($datos['tipo'] === 'Donacion') {
            $datos['precio'] = 0;
        } else {
            $datos['precio'] = $datos['precio'] ?? 0;
        }

        $archivo = $request->file('foto');
        $nombre  = time() . '_' . uniqid() . '.' . $archivo->getClientOriginalExtension();
        $archivo->move(public_path('img/publicaciones'), $nombre);
        $datos['foto'] = 'img/publicaciones/' . $nombre;

        Publicacion::create($datos);

        return redirect()->route('publicaciones.index')
            ->with('success', 'Publicación creada correctamente.');
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

    public function edit($id)
    {
        $publicacion = Publicacion::findOrFail($id);

        return view('publicaciones.edit', compact('publicacion'));
    }

    public function update(Request $request, $id)
    {
        $publicacion = Publicacion::findOrFail($id);

        $datos = $request->validate([
            'titulo'          => 'required|string|max:255',
            'descripcion'     => 'required|string',
            'tipo'            => 'required|in:Donacion,Venta',
            'precio'          => 'required_if:tipo,Venta|nullable|numeric|min:0',
            'categoria'       => 'required|string|max:255',
            'estado_articulo' => 'required|string|max:255',
        ], [
            'titulo.required'          => 'El título es obligatorio.',
            'descripcion.required'     => 'La descripción es obligatoria.',
            'tipo.required'            => 'Elige si es donación o venta.',
            'precio.required_if'       => 'Indica el precio si es una venta.',
            'categoria.required'       => 'Elige una categoría.',
            'estado_articulo.required' => 'Elige el estado del artículo.',
        ]);

        if ($datos['tipo'] === 'Donacion') {
            $datos['precio'] = 0;
        } else {
            $datos['precio'] = $datos['precio'] ?? 0;
        }

        $publicacion->update($datos);

        return redirect()->route('publicaciones.index')
            ->with('success', 'Publicación actualizada correctamente.');
    }

    public function destroy(Request $request, $id)
    {
        $publicaciones = $this->getPublicaciones($request);
        unset($publicaciones[$id]);
        $request->session()->put('publicaciones', $publicaciones);

        return redirect()->route('publicaciones.index')->with('success', 'Publicación eliminada de la sesión.');
    }
}
