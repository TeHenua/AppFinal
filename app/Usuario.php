<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $fillable = array('dni', 'nombre', 'apellido1','apellido2','fecha_nac','lugar_nac','direccion','localidad','codigo_pos','provincia','colegio','ocupacion','diagnostico','grado_discapacidad','grado_dependencia','puntos_movilidad','demanda','num_ss','tis','primera_entrevista','socio_id','alerta_custodia','alerta_medica','nombreSocio','estado');

    public function socio(){
    	 return $this->belongsTo('App\Socio');
    }

    public function contactos(){
    	return $this->belongsToMany('App\Contacto','contacto_usuario','usuario_id','contacto_id');
    }


   
}
