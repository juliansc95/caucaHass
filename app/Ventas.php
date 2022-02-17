<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    protected $table = 'ventas';
    protected $fillable = ['VentaNro','Fecha','CodProducto','DescripcionProducto',
    'Cantidad','Unidades','ValorBruto','Descuento','ValorNeto','Iva','ValorIva',
    'Descuento','ValorNeto','Iva','ValorIva','ImpuestoConsumo','TotalItem','Documento',
    'NombreTercero']; 
}
