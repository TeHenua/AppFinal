<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
	protected $fillable = array('numero', 'usuario1', 'usuario2','usuario3','usuario4','usuario5');
    protected $hidden = ['usuario1_nombre','usuario2_nombre','usuario3_nombre','usuario4_nombre','usuario5_nombre'];

}
