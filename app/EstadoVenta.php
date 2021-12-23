<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoVenta extends Model
{
    protected $table = 'estadoVentas';
    protected $fillable = ['nombre'];
}
