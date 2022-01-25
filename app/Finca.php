<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Finca extends Model
{
    protected $table = 'fincas';
    protected $fillable = ['nombre',
    'productor_id','areaPredio','longitudPredio','latitudPredio',
    'altitudPredio','departamento_id','municipio_id','vereda','posesion_id',
    'distanciaAlLote','distanciaLoteVia','coordenadasFinca']; 

    public function posesion(){
        return $this->belongsTo('App\Posesion', 'posesion_id', 'id');
    }
    public function departamento()
    {
        return $this->belongsTo('App\Departamento', 'departamento_id', 'id');
    }
    public function municipio()
    {
        return $this->belongsTo('App\Municipio', 'municipio_id', 'id');
    }
    public function productor(){
        return $this->belongsTo('App\Productor','productor_id','id');
    }
} 
