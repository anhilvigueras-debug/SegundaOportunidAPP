<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publicacion;
use App\Http\Requests\StorePublicacionRequest;
use App\Http\Requests\UpdatePublicacionRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

class PublicacionController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth', only: ['create', 'store', 'edit', 'update', 'destroy', 'finalizar']),
        ];
    }

    public function index(Request $request)
    {
        $query = Publicacion::with('user')
            ->where('disponible', true)
            ->latest();

        if ($request->filled('buscar')) {
            $termino = $request->buscar;
            $query->where(function ($q) use ($termino) {
                $q->where('titulo', 'ilike', "%{$termino}%")
                  ->orWhere('descripcion', 'ilike', "%{$termino}%");
            });
        }

        if ($request->filled('tipo') && in_array($request->tipo, ['Venta', 'Donacion'])) {
            $query->where('tipo', $request->tipo);
        }

        $publicaciones = $query->get();

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

        $datos['user_id'] = Auth::id();
        $datos['disponible'] = true;

        Publicacion::create($datos);

        return redirect()->route('publicaciones.index')
            ->with('success', 'Publicación creada correctamente.');
    }

    public function show($id)
    {
        $publicacion = Publicacion::with('user')->findOrFail($id);

        return view('publicaciones.show', compact('publicacion'));
    }

    public function edit($id)
    {
        $publicacion = Publicacion::findOrFail($id);

        if ($publicacion->user_id !== Auth::id()) {
            abort(403);
        }

        return view('publicaciones.edit', compact('publicacion'));
    }

    public function update(UpdatePublicacionRequest $request, $id)
    {
        $publicacion = Publicacion::findOrFail($id);

        if ($publicacion->user_id !== Auth::id()) {
            abort(403);
        }

        $datos = $request->validated();

        // Si es donación el precio siempre es 0
        $datos['precio'] = $datos['tipo'] === 'Donacion' ? 0 : ($datos['precio'] ?? 0);

        if ($request->hasFile('foto')) {
            $this->borrarFoto($publicacion->foto);
            $datos['foto'] = $this->guardarFoto($request->file('foto'));
        } else {
            unset($datos['foto']);
        }

        $publicacion->update($datos);

        return redirect()->route('publicaciones.index')
            ->with('success', 'Publicación actualizada correctamente.');
    }

    public function finalizar(Publicacion $publicacion)
    {
        if ($publicacion->user_id !== Auth::id()) {
            abort(403);
        }

        $publicacion->update(['disponible' => false]);

        return back()->with('success', 'Publicación marcada como finalizada.');
    }

    public function destroy($id)
    {
        $publicacion = Publicacion::findOrFail($id);

        if ($publicacion->user_id !== Auth::id()) {
            abort(403);
        }

        $this->borrarFoto($publicacion->foto);
        $publicacion->delete();

        return redirect()->route('publicaciones.index')
            ->with('success', 'Publicación eliminada correctamente.');
    }

    private function guardarFoto(UploadedFile $archivo): string
    {
        $nombre = time() . '_' . uniqid() . '.' . $archivo->getClientOriginalExtension();
        $archivo->move(public_path('img/publicaciones'), $nombre);

        return 'img/publicaciones/' . $nombre;
    }

    private function borrarFoto(?string $ruta): void
    {
        if ($ruta && file_exists(public_path($ruta))) {
            unlink(public_path($ruta));
        }
    }
}