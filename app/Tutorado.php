<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutorado extends Model
{
    protected $table = 'tutorados';
    protected $fillable = ['productor_id',
    'finca_id', 
    'tutorado', 
    'tipoTutorado',
    'tipoMadera'
    ];

    public function productor()
    {
        return $this->belongsTo('App\Productor','productor_id','id');
    }
    
    public function finca(){
        return $this->belongsTo('App\Finca', 'finca_id', 'id');
    }
}
