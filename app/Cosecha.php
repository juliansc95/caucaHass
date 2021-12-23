<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cosecha extends Model
{
    protected $table = 'cosechas';
    protected $fillable = ['productor_id',
    'finca_id', 
    'frecuencia',
    'clasificacion',
    'empaque',
    'transporte',
    'kilogramoMoraPrimera',
    'kilogramoMoraSegunda',
    'mesesProduccion',
    'clientes',
    'tiempoPago',
    'tipoPago'];

    public function productor()
    {
        return $this->belongsTo('App\Productor','productor_id','id');
    }
    
    public function finca(){
        return $this->belongsTo('App\Finca', 'finca_id', 'id');
    }
}
