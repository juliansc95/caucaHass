<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProduccionConcepto extends Model
{
    protected $table = 'produccionconceptos';
    protected $fillable = ['gastosproduccion_id','conceptoGasto_id','descripcion','otro','valorTotal',
                            ];

    public function adecuacionRenovacion(){
        return $this->belongsTo('App\GastosProduccion','gastosproduccion_id','id');
    }
    public function concepto(){
        return $this->belongsTo('App\ConceptoGasto','conceptoGasto_id','id');
    }
}
