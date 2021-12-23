<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GpxUpload extends Model
{
    protected $table = 'gpxs';
    protected $fillable = ['productor_id',
    'finca_id', 
    'latitud',
    'longitud',
    ];

    public function productor()
    {
        return $this->belongsTo('App\Productor','productor_id','id');
    }
    
    public function finca(){
        return $this->belongsTo('App\Finca', 'finca_id', 'id');
    }
}
