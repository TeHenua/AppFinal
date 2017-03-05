<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SocioRequest extends Request
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
            // 'nombre' => 'required',
            // 'apellido1' => 'required',
            // 'dni' => 'required|unique:socios,dni',
            // 'direccion' => 'required',
            // 'localidad' => 'required',
            // 'codigo_pos' => 'required|min:5|max:5',
            // 'provincia' => 'required',
            // 'fecha_nac' => 'required',
            // 'lugar_nac' => 'required',
            // 'num_cuenta' => 'required|unique:socios,num_cuenta|max:24|min:24',
            // 'fijo' => 'min:9|max:9',
            // 'movil' => 'min:9|max:9|required_without_all:fijo',
            // 'email' => 'required_if:tipo_comunicacion,email'
        ];
    }
}
