<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'nombres_usuario' => 'required|max:30',
            'apellidos_usuario' => 'required|max:30',
            'direccion_usuario' => 'required|max:30',
            'correo_usuario' => 'required|max:50',
            'telefono_usuario' => 'required|max:20',
            'rol_usuario' => 'required|max:15',
        ];

        if($this->clave_usuario) {
            $rules['clave_usuario'] = 'required|confirmed';
        }

        if ($this->method() === 'POST') {
            $rules['nombres_usuario'] = 'required|max:30';
            $rules['apellidos_usuario'] = 'required|max:30';
            $rules['direccion_usuario'] = 'required|max:30';
            $rules['correo_usuario'] = 'required|max:50';
            $rules['telefono_usuario'] = 'required|max:20';
            $rules['clave_usuario'] = 'required|confirmed';
            $rules['rol_usuario'] = 'required|max:15';
        }


        return $rules;
    }
}
