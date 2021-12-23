<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Riego extends Model
{
    protected $table = 'riegos';
    protected $fillable = ['productor_id',
    'finca_id', 
    'riego', 
    'adquisicion',
    'frecuencia',
    'tipo',
    'tiempo',
    'jornales',
    'reservorio',
    'capacidadR',
    'alturaR'
    ];

    public function productor()
    {
        return $this->belongsTo('App\Productor','productor_id','id');
    }
    
    public function finca(){
        return $this->belongsTo('App\Finca', 'finca_id', 'id');
    }
}
