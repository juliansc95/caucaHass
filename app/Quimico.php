<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quimico extends Model
{
    protected $table ='quimicos';
    protected $fillable=[
        'nombre'
    ];
}
