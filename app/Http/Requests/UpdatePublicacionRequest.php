<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePublicacionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titulo'          => ['required', 'string', 'max:255'],
            'descripcion'     => ['required', 'string', 'max:2000'],
            'tipo'            => ['required', 'in:Donacion,Venta'],
            'precio'          => ['required_if:tipo,Venta', 'nullable', 'numeric', 'min:0', 'max:999999.99'],
            'categoria'       => ['required', 'string', 'max:255'],
            'estado_articulo' => ['required', 'string', 'max:255'],
            'foto'            => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'titulo.required'          => 'El título es obligatorio.',
            'titulo.max'               => 'El título no puede tener más de 255 caracteres.',
            'descripcion.required'     => 'La descripción es obligatoria.',
            'descripcion.max'          => 'La descripción no puede tener más de 2000 caracteres.',
            'tipo.required'            => 'Elige si es donación o venta.',
            'tipo.in'                  => 'El tipo de publicación no es válido.',
            'precio.required_if'       => 'Indica el precio si es una venta.',
            'precio.numeric'           => 'El precio debe ser un número.',
            'precio.min'               => 'El precio no puede ser negativo.',
            'categoria.required'       => 'Elige una categoría.',
            'estado_articulo.required' => 'Elige el estado del artículo.',
            'foto.image'               => 'El archivo debe ser una imagen.',
            'foto.mimes'               => 'La foto debe ser JPG, PNG o WEBP.',
            'foto.max'                 => 'La foto no debe pesar más de 2 MB.',
        ];
    }
}
