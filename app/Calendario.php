<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendario extends Model
{
    protected $table = 'calendarios';
    protected $fillable = ['fechaIni','fechaFin','todoeldia','color','titulo','grupo_id','user_id','usuario_id', 'borrado'];
    protected $hidden = ['id','usuario_nombre'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
