<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnidadAplicacion extends Model
{
    protected $table = 'unidad_aplicaciones';
    protected $fillable = ['nombre'];
}
