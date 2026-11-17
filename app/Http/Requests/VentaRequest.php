<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class VentaRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array
    {
        return [
            'publicacion_id' => ['required', 'integer', Rule::exists('publicacions', 'id')->where(fn ($query) => $query->where('tipo', 'Venta')->where('precio', '>', 0)), Rule::unique('ventas', 'publicacion_id')->ignore($this->route('venta'))],
            'comprador' => ['required', 'string', 'max:120'],
            'confirmacion' => ['accepted'],
        ];
    }
    public function messages(): array
    {
        return ['required'=>'El campo :attribute es obligatorio.', 'string'=>'El campo :attribute debe ser texto.', 'max.string'=>'El campo :attribute excede el límite permitido.', 'integer'=>'El valor seleccionado no es válido.', 'accepted'=>'Debes confirmar la operación.', 'publicacion_id.required'=>'Selecciona una publicación.', 'publicacion_id.exists'=>'Selecciona una publicación de venta con precio mayor a cero.', 'publicacion_id.unique'=>'Esta publicación ya tiene una venta registrada.', 'comprador.required'=>'Escribe el nombre del comprador.', 'comprador.max'=>'El nombre no puede superar 120 caracteres.', 'confirmacion.accepted'=>'Confirma que deseas registrar la venta.'];
    }
}
