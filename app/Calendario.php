<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendario extends Model
{
    protected $table = 'calendarios';
    protected $fillable = ['fechaIni','fechaFin','todoeldia','lugar','color','titulo','user_id','usuario_id'];
    protected $hidden = ['id','usuario_nombre'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
