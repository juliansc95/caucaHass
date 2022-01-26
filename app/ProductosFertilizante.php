<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductosFertilizante extends Model
{
    
    protected $table ='productosfertilizantes';
    protected $fillable=[
        'nombre'
    ];
}
