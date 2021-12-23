<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GpxZones extends Model
{
    protected $table = 'gpxzones';
    protected $fillable = ['productor_id',
    'finca_id', 
    'latitud',
    'linea',
    ];

    public function productor()
    {
        return $this->belongsTo('App\Productor','productor_id','id');
    }
    
    public function finca(){
        return $this->belongsTo('App\Finca', 'finca_id', 'id');
    }
}
