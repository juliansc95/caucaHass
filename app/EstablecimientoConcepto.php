<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstablecimientoConcepto extends Model
{
    protected $table = 'establecimientoconceptos';
    protected $fillable = ['gastosEstablecimiento_id','conceptoGasto_id','descripcion','otro','valorTotal',
                            ];

    public function gastosEstablecimiento(){
        return $this->belongsTo('App\GastosEstablecimiento','gastosEstablecimiento_id','id');
    }
    public function concepto(){
        return $this->belongsTo('App\ConceptoGasto','conceptoGasto_id','id');
    }
}
