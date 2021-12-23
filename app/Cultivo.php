<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cultivo extends Model
{
    protected $table = 'cultivos';
    protected $fillable = ['productor_id','finca_id','cadena_id','areaSembrada',
    'fechaSiembra','numeroPlantulasArboles','totalVentasKgAnioAnterior','precioPromedio',
    'TotalVentasAnioAnterior','lugarVenta_id']; 

    public function finca(){
        return $this->belongsTo('App\Finca','finca_id','id');
    }
    public function productor(){
        return $this->belongsTo('App\Productor','productor_id','id');
    }
    public function cadena(){
        return $this->belongsTo('App\Cadena','cadena_id','id');
    }
    public function lugarVenta(){
        return $this->belongsTo('App\LugarVenta','lugarVenta_id','id');
    }
}
