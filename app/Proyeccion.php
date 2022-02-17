<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyeccion extends Model
{
    protected $table = 'proyeccions';
    protected $fillable = [
    'productor_id','finca_id','arbolesLoteUno','EdadArbolesLoteUno',
    'kgProyectados','arbolesLoteDos','EdadArbolesLoteDos','kgProyectadoLoteDos']; 

    public function productor(){
        return $this->belongsTo('App\Productor','productor_id','id');
    }

    public function finca(){
        return $this->belongsTo('App\Finca','finca_id','id');
    }
}
