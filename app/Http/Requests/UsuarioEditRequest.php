<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UsuarioEditRequest extends Request
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
            'nombre' => 'required',
            'apellido1' => 'required',
            'direccion' => 'required',
            'localidad' => 'required',
            'codigo_pos' => 'required|min:5|max:5',
            'provincia' => 'required',
            'fecha_nac' => 'required',
            'lugar_nac' => 'required',
            'num_ss' => 'required',
            'primera_entrevista' => 'required',
            'diagnostico' => 'required'
        ];
    }
}
