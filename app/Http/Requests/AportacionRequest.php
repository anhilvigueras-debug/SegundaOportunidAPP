<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class AportacionRequest extends FormRequest
{
    public function authorize(): bool { return true; }
    public function rules(): array
    {
        return [
            'nombre'=>['required','string','max:120'], 'correo'=>['required','email','max:254'],
            'monto'=>['required','numeric','decimal:0,2','min:0.01','max:99999999.99'],
            'referencia'=>['required','string','max:100',Rule::unique('aportaciones','referencia')->ignore($this->route('aportacion'))],
            'comprobante'=>[$this->isMethod('post') ? 'required' : 'nullable','file','mimes:pdf,jpg,jpeg,png','max:2048'],
            'confirmacion'=>['accepted'],
        ];
    }
    public function messages(): array
    {
        return ['required'=>'El campo :attribute es obligatorio.', 'string'=>'El campo :attribute debe ser texto.', 'max.string'=>'El campo :attribute excede el límite permitido.', 'max.numeric'=>'El valor de :attribute excede el límite permitido.', 'file'=>'Adjunta un archivo válido.', 'uploaded'=>'No se pudo cargar el comprobante.', 'accepted'=>'Debes confirmar la operación.', 'nombre.required'=>'Escribe tu nombre.', 'correo.required'=>'Escribe tu correo.', 'correo.email'=>'Escribe un correo válido.', 'monto.required'=>'Escribe el monto.', 'monto.numeric'=>'El monto debe ser un número.', 'monto.min'=>'El monto debe ser mayor a cero.', 'monto.decimal'=>'El monto admite hasta dos decimales.', 'referencia.required'=>'Escribe la referencia de la operación.', 'referencia.unique'=>'Esta referencia ya está registrada.', 'comprobante.required'=>'Adjunta un comprobante.', 'comprobante.mimes'=>'El comprobante debe ser PDF, JPG o PNG.', 'comprobante.max'=>'El comprobante no debe superar 2 MB.', 'confirmacion.accepted'=>'Confirma que deseas registrar la aportación.'];
    }
}
