<?php
namespace App\Http\Controllers;
use App\Http\Requests\PublicacionRequest;
use App\Models\Publicacion;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
class PublicacionController extends Controller
{
    public function index(): View { return view('publicaciones.index', ['publicaciones'=>Publicacion::latest()->paginate(12)]); }
    public function create(): View { return view('publicaciones.create', ['publicacion'=>new Publicacion]); }
    public function store(PublicacionRequest $request): RedirectResponse { Publicacion::create($request->validated()); return redirect()->route('publicaciones.index')->with('success','Publicación creada.'); }
    public function show(Publicacion $publicacione): View { return view('publicaciones.show', ['publicacion'=>$publicacione]); }
    public function edit(Publicacion $publicacione): View { return view('publicaciones.edit', ['publicacion'=>$publicacione]); }
    public function update(PublicacionRequest $request, Publicacion $publicacione): RedirectResponse { $publicacione->update($request->validated()); return redirect()->route('publicaciones.index')->with('success','Publicación actualizada.'); }
    public function destroy(Publicacion $publicacione): RedirectResponse
    {
        if ($publicacione->venta()->exists()) { return back()->with('error','No se puede eliminar una publicación con una venta registrada.'); }
        $publicacione->delete(); return redirect()->route('publicaciones.index')->with('success','Publicación eliminada.');
    }
}
