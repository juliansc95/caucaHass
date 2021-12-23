<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vereda extends Model
{
    protected $table = 'veredas';
    protected $fillable = ['nombre','municipio_id'];
    public function municipio()
    {
        return $this->belongsTo('App\Municipio', 'municipio_id', 'id');
    }
}
