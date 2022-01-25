<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AplicacionQuimico extends Model
{
    protected $table = 'aplquimicos';
    protected $fillable = [
    'productor_id','finca_id','fechaAplicacion','quimico_id',
    'nombreIngenieroAgronomo','concentracion','RegistroICA','Dosis',
    'periodoCarencia','periodoEntrada','formaAplicacion',
    'recomendo','Aplico']; 

    public function productor(){
        return $this->belongsTo('App\Productor','productor_id','id');
    }

    public function finca(){
        return $this->belongsTo('App\Finca','finca_id','id');
    }
}
