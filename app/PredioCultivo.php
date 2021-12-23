<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PredioCultivo extends Model
{
    protected $table = 'predioCultivos';
    protected $fillable = ['productor_id',
    'finca_id', 
    'areaSembradaPredio', 
    'fechaSiembra',
    'numeroPlantasTotales',
    'numeroPlantasProduccion',
    'plantasErradicadas',
    'plantasLevante',
    'TipoMora',
    'vereda_id',
    'tipoReproduccion',
    'bolsa'
    ];

    public function productor()
    {
        return $this->belongsTo('App\Productor','productor_id','id');
    }
    
    public function finca(){
        return $this->belongsTo('App\Finca', 'finca_id', 'id');
    }

    public function vereda(){
        return $this->belongsTo('App\Vereda', 'vereda_id', 'id');
    }
}
