<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EncuestaFitosanitaria extends Model
{
    protected $table = 'encuesta_fitosanitarias';
    protected $fillable = ['productor_id',
    'finca_id','fecha_control','productoSembrado','lote','linea_id',
    'numeroPlantas','producto_fitosanitario_id','cantidad_dosis','unidad_dosis_id',
    'unidad_aplicaciones_id','cantidad_aplicacion','equipo_aplicaciones_id',
    'metodo_aplicaciones_id'];

    //public $timestamps=false;
    
    public function productor()
    {
        return $this->belongsTo('App\Productor','productor_id','id');
    }
    
    public function finca(){
        return $this->belongsTo('App\Finca', 'finca_id', 'id');
    }

    public function linea(){
        return $this->belongsTo('App\Linea', 'linea_id', 'id');
    }

    public function producto(){
        return $this->belongsTo('App\ProductoFitosanitario', 'linea_id', 'id');
    }

    public function unidadDosis(){
        return $this->belongsTo('App\UnidadDosis', 'unidad_dosis_id', 'id');
    }

    public function unidadAplicacion(){
        return $this->belongsTo('App\UnidadAplicacion', 'unidad_aplicaciones_id', 'id');
    }

    public function equipoAplicacion(){
        return $this->belongsTo('App\EquipoAplicacion', 'equipo_aplicaciones_id', 'id');
    }

    public function metodoAplicacion(){
        return $this->belongsTo('App\MetodoAplicacion', 'metodo_aplicaciones_id', 'id');
    }


}
