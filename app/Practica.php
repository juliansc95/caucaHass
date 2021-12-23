<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Practica extends Model
{
    protected $table = 'practicas';
    protected $fillable = ['productor_id',
    'finca_id', 
    'vivenda',
    'viveSitio',
    'bateriaSanitaria',
    'pozoSeptico',
    'zonaBarbecho',
    'usaBarbecho',
    'agroquimicos',
    'mezclaAgroquimicos',
    'usaAgroquimicos',
    'bodegaMateriales',
    'usaBodega',
    'canastillas',
    'usaCanastillas',
    'trajeProteccion',
    'usaTraje',
    'puntoEcologico',
    'usaPuntoEcologico',
    'botiquin',
    'usaBotiquin',
    'extintor',
    'usaExtintor',
    'capacitacionesBPA',
    'certificadas',
    'institucionCertificado',
    'tiempo'
    ];

    public function productor()
    {
        return $this->belongsTo('App\Productor','productor_id','id');
    }
    
    public function finca(){
        return $this->belongsTo('App\Finca', 'finca_id', 'id');
    }
}
