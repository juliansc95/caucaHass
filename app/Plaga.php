<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plaga extends Model
{
    protected $table = 'plagas';
    protected $fillable = ['productor_id',
    'finca_id', 'monitoreo', 
    'frecuenciaMonitoreo','perlaTierra', 
    'tipoManejoPerla','frecuenciaAplicacionPerla', 
    'barrenadorCultivo','tipoManejoBarrenador',
    'frecuenciaAplicacionBarrenador','tripsCultivo',
    'tipoManejoTrips','frecuenciaAplicacionTrips',
     'afidiosCultivos', 'tipoManejoAfidios', 
    'frecuenciaAplicacionAfidios',            
    'acarosCultivos', 
    'tipoManejoAcaros',
    'frecuenciaAplicacionAcaros', 
    'cochinillaCultivos',
    'tipoManejoCochinilla',
    'frecuenciaAplicacionCochinilla'
    ];

    public function productor()
    {
        return $this->belongsTo('App\Productor','productor_id','id');
    }
    
    public function finca(){
        return $this->belongsTo('App\Finca', 'finca_id', 'id');
    }
}
