<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VentaCategoria extends Model
{
    protected $table = 'ventas_categorias';
    protected $fillable = ['ventas_id','categoria_id','peso','valorUnitario','subtotal',
                            ];

    public function venta(){
        return $this->belongsTo('App\Venta','ventas_id','id');
    }
    public function lugarVenta(){
        return $this->belongsTo('App\CategoriaMora','categoria_id','id');
    }
}
