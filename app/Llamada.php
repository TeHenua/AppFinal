<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Llamada extends Model
{
    protected $table = 'llamadas';
    protected $fillable = ['motivo','nombre','telefono','otros','user_id'];
}
