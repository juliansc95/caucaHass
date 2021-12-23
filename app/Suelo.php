<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suelo extends Model
{
    protected $table = 'suelos';
    protected $fillable = ['productor_id',
    'finca_id', 
    'curvasNivel',
    'controlArvenses',
    'frecuencia',
    'herbicida', 
    'dosisAplicacionCal',
    'frecuenciaHerbicida'
    ];

    public function productor()
    {
        return $this->belongsTo('App\Productor','productor_id','id');
    }
    
    public function finca(){
        return $this->belongsTo('App\Finca', 'finca_id', 'id');
    }
}
