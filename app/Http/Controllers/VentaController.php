<?php
namespace App\Http\Controllers;
use App\Http\Requests\VentaRequest;
use App\Models\Publicacion;
use App\Models\Venta;
use App\Services\RegistrarVenta;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
class VentaController extends Controller
{
    public function index(): View { return view('ventas.index',['ventas'=>Venta::with('publicacion')->latest()->paginate(10)]); }
    public function create(): View { return view('ventas.form',['venta'=>new Venta, 'publicaciones'=>Publicacion::where('tipo','Venta')->where('precio','>',0)->doesntHave('venta')->orderBy('titulo')->get()]); }
    public function store(VentaRequest $request, RegistrarVenta $registrar): RedirectResponse { $registrar->guardar($request->validated()); return redirect()->route('ventas.index')->with('success','Venta registrada y comisión calculada.'); }
    public function show(Venta $venta): View { return view('ventas.show',['venta'=>$venta->load('publicacion')]); }
    public function edit(Venta $venta): View { return view('ventas.form',['venta'=>$venta, 'publicaciones'=>Publicacion::whereKey($venta->publicacion_id)->get()]); }
    public function update(VentaRequest $request, Venta $venta): RedirectResponse { $venta->update(['comprador'=>$request->validated('comprador')]); return redirect()->route('ventas.show',$venta)->with('success','Venta actualizada.'); }
    public function destroy(Venta $venta): RedirectResponse { $venta->delete(); return redirect()->route('ventas.index')->with('success','Registro de venta eliminado.'); }
}
