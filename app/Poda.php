<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poda extends Model
{
    protected $table = 'podas';
    protected $fillable = ['productor_id',
    'finca_id',
    'estadoVegetativo',
    'podaFormacion',
    'podaAclareo',
    'frecuenciaAclareo',
    'podaMantenimiento',
    'frecuenciaMantenimiento',
    'podaFitosanitaria',
    'frecuenciaFitosanitaria'
    ];

    public function productor()
    {
        return $this->belongsTo('App\Productor','productor_id','id');
    }
    
    public function finca(){
        return $this->belongsTo('App\Finca', 'finca_id', 'id');
    }
}
