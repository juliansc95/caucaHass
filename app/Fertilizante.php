<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fertilizante extends Model
{
    protected $table = 'fertilizantes';
    protected $fillable = [
    'productor_id','finca_id','fechaAplicacion','nombreProducto',
    'nombreIngenieroAgronomo','concentracion','RegistroICA','Dosis','formaAplicacion',
    'recomendo','Aplico']; 

    public function productor(){
        return $this->belongsTo('App\Productor','productor_id','id');
    }

    public function finca(){
        return $this->belongsTo('App\Finca','finca_id','id');
    }

}
