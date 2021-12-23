<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EncuestaAsofrut extends Model
{
    protected $table = 'encuestaAsofruts';
    protected $fillable = ['productor_id',
    'finca_id','certificacion1','certificacion2','ecosistemas1','ecosistemas2','ecosistemas3',
    'ecosistemas4','ecosistemas5','ecosistemas6','ecosistemas7','ecosistemas8','silvestre1',
    'silvestre2','silvestre3','silvestre4','silvestre5','silvestre6','silvestre7','silvestre8',
    'silvestre9','silvestre10','silvestre11','silvestre12','silvestre13','silvestre14',
    'silvestre15','silvestre16','silvestre17','silvestre18','silvestre19','silvestre20',
    'conservacion1','conservacion2','conservacion3','conservacion4','conservacion5','conservacion6',
    'desechos1','desechos2','desechos3','desechos4','cultivo'];

    public function productor()
    {
        return $this->belongsTo('App\Productor','productor_id','id');
    }
    
    public function finca(){
        return $this->belongsTo('App\Finca', 'finca_id', 'id');
    }

}
