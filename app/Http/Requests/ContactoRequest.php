<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ContactoRequest extends Request
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
        return [
            'nombre_usuario' => 'required',
            'apellido1_usuario' => 'required',
            'parentesco' => 'required',
            'nombre' => 'required',
            'apellido1' => 'required',
            'direccion' => 'requiredrequired_if:tipo_comunicacion,carta|required_if:tipo_comunicacion,carta_sin',
            'localidad' => 'requiredrequired_if:tipo_comunicacion,carta|required_if:tipo_comunicacion,carta_sin',
            'codigo_pos' => 'requiredrequired_if:tipo_comunicacion,carta|required_if:tipo_comunicacion,carta_sin|min:5|max:5',
            'provincia' => 'requiredrequired_if:tipo_comunicacion,carta|required_if:tipo_comunicacion,carta_sin',
            'email' => 'required_if:tipo_comunicacion,email'
        ];
    }
}
