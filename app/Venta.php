<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'ventas';
    protected $fillable = ['productor_id',
    'linea_id','fechaVenta','lugarVenta_id','totalVenta','totalKilos',
    'totalDonacion','totalTransporte','totalAsohof','totalCuatroXmil','estado_id'];

    public function productor(){
        return $this->belongsTo('App\Productor','productor_id','id');
    }
    public function lugarVenta(){
        return $this->belongsTo('App\LugarVenta','lugarVenta_id','id');
    }
    public function linea(){
        return $this->belongsTo('App\Linea','linea_id','id');
    }
    public function estadoVenta(){
        return $this->belongsTo('App\EstadoVenta','estado_id','id');
    }
}
