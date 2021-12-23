<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EquipoAplicacion extends Model
{
    protected $table = 'equipo_aplicaciones';
    protected $fillable = ['nombre'];
}
