<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected  $table='roles';
    protected $fillable =['nombre','descripcion','condicion'];
    public $timestamps= false;

    public function users(){
        return $this->hasMany('App\User');
    }

    public function selectRol(Request $request){
        $roles= Rol::where('condicion','=','1')
        ->select('id','nombre')
        ->orderBy('nombre','asc')->get();

        return ['roles'=>$roles];
    }
}
