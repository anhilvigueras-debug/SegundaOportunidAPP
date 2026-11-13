<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class PublicacionRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array
    {
        return ['titulo'=>['required','string','max:255'], 'descripcion'=>['required','string'], 'tipo'=>['required',Rule::in(['Venta','Donacion'])], 'precio'=>['required','numeric','decimal:0,2','min:0','max:999999.99', Rule::requiredIf($this->input('tipo') === 'Venta')], 'categoria'=>['required','string','max:255'], 'estado_articulo'=>['required','string','max:255']];
    }
    public function messages(): array { return ['required'=>'El campo :attribute es obligatorio.', 'string'=>'El campo :attribute debe ser texto.', 'max.string'=>'El campo :attribute excede el límite permitido.', 'max.numeric'=>'El valor de :attribute excede el límite permitido.', 'in'=>'Selecciona una opción válida.', 'numeric'=>'El campo :attribute debe ser un número válido.', 'min'=>'El valor de :attribute no puede ser negativo.', 'decimal'=>'El campo :attribute admite hasta dos decimales.']; }
}
