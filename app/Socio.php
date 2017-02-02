<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Socio extends Model
{

	protected $fillable = array('num_socio','tipo_socio','dni', 'nombre', 'apellido1','apellido2','fecha_nac','lugar_nac','direccion','localidad','codigo_pos','provincia','fijo','movil','email','tipo_comunicacion','num_cuenta','ocupacion','estado');

    
	public function usuarios(){
		return $this->hasMany('App\Usuario');
	}

    

}
