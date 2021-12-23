<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnidadDosis extends Model
{
    protected $table = 'unidad_dosis';
    protected $fillable = ['nombre']; 
}
