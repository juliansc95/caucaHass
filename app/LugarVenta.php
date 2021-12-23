<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LugarVenta extends Model
{
    protected $table = 'lugarVentas';
    protected $fillable = ['nombre']; 
}
