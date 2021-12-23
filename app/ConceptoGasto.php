<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConceptoGasto extends Model
{
    protected $table = 'conceptogastos';
    protected $fillable = ['nombre']; 
}
