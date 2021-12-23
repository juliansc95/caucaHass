<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nutricion extends Model
{
    protected $table = 'nutricions';
    protected $fillable = ['productor_id',
    'finca_id', 
    'analisis', 
    'fechaAnalisis', 
    'fertilizaAnalisis', 
    'aplicacionesCal',
    'aplicoSiembraCal', 
    'dosisAplicacionCal',
    'formaAplicacionCal',
    'frecuenciaAplicacionCal',
    'fechaCal',
    'aplicacionesMateriaOrganica',
    'aplicoSiembraMateriaOrganica',
    'dosisAplicacionMateriaOrganica',
    'formaAplicacionMateriaOrganica',
    'frecuenciaAplicacionMateriaOrganica',
    'fechaMateriaOrganica',
    'fechaUltimaFertilizacion',
    'formaAplicacionFert',
    'frecuenciaAplicacionFert'
    ];

    public function productor()
    {
        return $this->belongsTo('App\Productor','productor_id','id');
    }
    
    public function finca(){
        return $this->belongsTo('App\Finca', 'finca_id', 'id');
    }
}
