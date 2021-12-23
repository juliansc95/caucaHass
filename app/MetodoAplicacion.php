<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetodoAplicacion extends Model
{
    protected $table = 'metodo_aplicaciones';
    protected $fillable = ['nombre'];
}
