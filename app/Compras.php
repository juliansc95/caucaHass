<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compras extends Model
{
    protected $table = 'compras';
    protected $fillable = ['CompraNro','Fecha','CodProducto','DescripcionProducto',
    'Cantidad','Unidades','ValorBruto','Descuento','ValorNeto','Iva','ValorIva',
    'ImpuestoConsumo','TotalItem','Documento',
    'NombreTercero']; 
}
