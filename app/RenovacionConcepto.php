<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RenovacionConcepto extends Model
{
    protected $table = 'renovacionconceptos';
    protected $fillable = ['adecuacionrenovacion_id','conceptoGasto_id','descripcion','otro','valorTotal',
                            ];

    public function adecuacionRenovacion(){
        return $this->belongsTo('App\AdecuacionRenovacion','adecuacionrenovacion_id','id');
    }
    public function concepto(){
        return $this->belongsTo('App\ConceptoGasto','conceptoGasto_id','id');
    }
}
