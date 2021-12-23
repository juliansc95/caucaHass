<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductoFitosanitario extends Model
{
    protected $table = 'producto_fitosanitarios';
    protected $fillable = ['nombre']; 
}
