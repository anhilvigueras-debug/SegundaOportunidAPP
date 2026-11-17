<?php
namespace App\Http\Controllers;
use App\Http\Requests\AportacionRequest;
use App\Models\Aportacion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
class AportacionController extends Controller
{
    public function index(): View { return view('aportaciones.index',['aportaciones'=>Aportacion::latest()->paginate(10)]); }
    public function create(): View { return view('aportaciones.form',['aportacion'=>new Aportacion]); }
    public function store(AportacionRequest $request): RedirectResponse
    {
        $aportacion = Aportacion::create($this->datos($request));
        return redirect()->route('aportaciones.show',$aportacion)->with('success','Aportación registrada. El comprobante está pendiente de revisión.');
    }
    public function show(Aportacion $aportacion): View { return view('aportaciones.show',compact('aportacion')); }
    public function edit(Aportacion $aportacion): View { return view('aportaciones.form',compact('aportacion')); }
    public function update(AportacionRequest $request, Aportacion $aportacion): RedirectResponse
    {
        $aportacion->update($this->datos($request));
        return redirect()->route('aportaciones.show',$aportacion)->with('success','Aportación actualizada.');
    }
    public function destroy(Aportacion $aportacion): RedirectResponse { $aportacion->delete(); return redirect()->route('aportaciones.index')->with('success','Aportación eliminada.'); }
    public function comprobante(Aportacion $aportacion): Response
    {
        return response(base64_decode($aportacion->comprobante_contenido, true), 200, ['Content-Type'=>$aportacion->comprobante_tipo, 'Content-Disposition'=>'attachment; filename="comprobante-'.$aportacion->id.'"', 'X-Content-Type-Options'=>'nosniff']);
    }
    private function datos(AportacionRequest $request): array
    {
        $datos = $request->safe()->only(['nombre','correo','monto','referencia']);
        if ($request->hasFile('comprobante')) {
            $archivo = $request->file('comprobante');
            $datos += ['comprobante_nombre'=>substr($archivo->getClientOriginalName(),0,255), 'comprobante_tipo'=>$archivo->getMimeType(), 'comprobante_contenido'=>base64_encode(file_get_contents($archivo->getRealPath()))];
        }
        return $datos;
    }
}
