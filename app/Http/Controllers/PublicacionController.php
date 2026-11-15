<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publicacion;
use App\Http\Requests\StorePublicacionRequest;
use App\Http\Requests\UpdatePublicacionRequest;
use Illuminate\Http\UploadedFile;

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

    public function store(StorePublicacionRequest $request)
    {
        $datos = $request->validated();

        // Si es donación el precio siempre es 0
        $datos['precio'] = $datos['tipo'] === 'Donacion' ? 0 : ($datos['precio'] ?? 0);

        $datos['foto'] = $this->guardarFoto($request->file('foto'));

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

    public function update(UpdatePublicacionRequest $request, $id)
    {
        $publicacion = Publicacion::findOrFail($id);

        $datos = $request->validated();

        // Si es donación el precio siempre es 0
        $datos['precio'] = $datos['tipo'] === 'Donacion' ? 0 : ($datos['precio'] ?? 0);

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

    private function guardarFoto(UploadedFile $archivo): string
    {
        $nombre = time() . '_' . uniqid() . '.' . $archivo->getClientOriginalExtension();
        $archivo->move(public_path('img/publicaciones'), $nombre);

        return 'img/publicaciones/' . $nombre;
    }
}
