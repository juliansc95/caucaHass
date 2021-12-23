<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vocacion extends Model
{
    protected $table = 'vocacions';
    protected $fillable = ['productor_id',
    'finca_id', 
    'vocacion',
    'tiempo',
    'practicaBasica',
    'capacitacionRefuerzo',
    'temasRefuerzo',
    'diasMora',
    'labores',
    'motivo'    
    ];

    public function productor()
    {
        return $this->belongsTo('App\Productor','productor_id','id');
    }
    
    public function finca(){
        return $this->belongsTo('App\Finca', 'finca_id', 'id');
    }
}
