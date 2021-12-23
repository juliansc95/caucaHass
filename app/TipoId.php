<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoId extends Model
{
    protected $table = 'tipoIds';
    protected $fillable = ['nombre']; 
}
