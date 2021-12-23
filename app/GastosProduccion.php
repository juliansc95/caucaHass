<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GastosProduccion extends Model
{
    protected $table = 'gastosproduccions';
    protected $fillable = ['productor_id',
    'finca_id','fechaRegistro'];

    public function productor(){
        return $this->belongsTo('App\Productor','productor_id','id');
    }
    public function finca(){
        return $this->belongsTo('App\Fincas','finca_id','id');
    }
}
