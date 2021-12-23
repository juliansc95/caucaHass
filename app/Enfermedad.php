<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enfermedad extends Model
{
    protected $table = 'enfermedads';
    protected $fillable = ['productor_id',
    'finca_id', 
    'monitoreo',
    'frecuenciaMonitoreo',
    'antracnosis',
    'tipoManejoAntra',
    'frecuenciaAntra',
    'botritys',
    'tipoManejoBotritys',
    'frecuenciaBotritys',
    'mildeo',
    'tipoManejoMildeo',
    'frecuenciaMildeo',
    'mildeoVelloso',
    'tipoManejoMildeoVelloso',
    'frecuenciaMildeoVelloso',
    'adherentes',
    'nombreAdherente',
    'dosisAplicacion'
    ];

    public function productor()
    {
        return $this->belongsTo('App\Productor','productor_id','id');
    }

    public function finca(){
        return $this->belongsTo('App\Finca', 'finca_id', 'id');
    }

}
