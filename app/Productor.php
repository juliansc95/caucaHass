<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productor extends Model
{
    protected $table = 'productors';
    protected $fillable = ['fechaExpedicion',
    'fechaNacimiento','sexo_id','departamento_id',
    'municipio_id','vereda','fechaIngreso']; 

    public $timestamps=false;

    public function persona()
    {
        return $this->belongsTo('App\Persona');
    }
    
    public function sexo(){
        return $this->belongsTo('App\Sexo', 'sexo_id', 'id');
    }
    public function etnia(){
        return $this->belongsTo('App\Etnia', 'etnia_id', 'id');
    }
    public function gradoescolaridad(){
        return $this->belongsTo('App\GradoEscolaridad', 'escolaridad_id', 'id');
    }
    public function departamento()
    {
        return $this->belongsTo('App\Departamento', 'departamento_id', 'id');
    }
    public function municipio()
    {
        return $this->belongsTo('App\Municipio', 'municipio_id', 'id');
    }
    

    
 
}
