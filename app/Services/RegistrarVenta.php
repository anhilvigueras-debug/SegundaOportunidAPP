<?php
namespace App\Services;
use App\Models\Publicacion;
use App\Models\Venta;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
class RegistrarVenta
{
    public function guardar(array $datos, ?Venta $venta = null): Venta
    {
        return DB::transaction(function () use ($datos, $venta) {
            $publicacion = Publicacion::query()->lockForUpdate()->findOrFail($datos['publicacion_id']);
            if ($publicacion->tipo !== 'Venta' || (float) $publicacion->precio <= 0 || Venta::where('publicacion_id', $publicacion->id)->when($venta, fn ($q) => $q->whereKeyNot($venta->id))->exists()) {
                throw ValidationException::withMessages(['publicacion_id' => 'La publicación ya no está disponible para venta.']);
            }
            $puntos = (int) config('transacciones.comision_puntos_base');
            if ($puntos < 0 || $puntos > 10000) {
                throw ValidationException::withMessages(['publicacion_id' => 'La comisión configurada no es válida.']);
            }
            [$pesos, $centavos] = explode('.', $publicacion->precio);
            $total = ((int) $pesos * 100) + (int) $centavos;
            $comision = intdiv(($total * $puntos) + 5000, 10000);
            $moneda = fn (int $centimos) => sprintf('%d.%02d', intdiv($centimos, 100), $centimos % 100);
            $venta ??= new Venta;
            $venta->fill(['publicacion_id'=>$publicacion->id, 'comprador'=>$datos['comprador'], 'monto'=>$moneda($total), 'comision_puntos_base'=>$puntos, 'comision'=>$moneda($comision), 'monto_vendedor'=>$moneda($total-$comision)]);
            $venta->save();
            return $venta;
        });
    }
}
