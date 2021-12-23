<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GradoEscolaridad extends Model
{
    protected $table = 'gradoEscolaridads';
    protected $fillable = ['nombre'];
}
