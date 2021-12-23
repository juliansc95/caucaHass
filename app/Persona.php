<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $fillable=['nombre','tipo_id','num_documento','direccion','telefono','email'];

    public function productor()
    {
        return $this->hasOne('App\Productor');
    }
    public function tipoid(){
        return $this->belongsTo('App\TipoId', 'tipo_id', 'id');
    }

    public function user(){
        return $this->hasOne('App\User');
    }

}
