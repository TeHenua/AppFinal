<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
	protected $fillable = array('dni', 'nombre', 'apellido1','apellido2','fecha_nac','lugar_nac','direccion','localidad','codigo_pos','fijo','movil','email','tipo_comunicacion','parentesco', 'nombreUsuario');

	public function usuarios(){
		return $this->belongsToMany('App\Usuario', 'contacto_usuario','contacto_id','usuario_id');
	}
    
}
