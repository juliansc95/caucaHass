<?php

namespace App\Imports;

use App\Ventas;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class VentasImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Ventas([
            'VentaNro'  => $row[0],
            'Fecha' => $row[1],
            'CodProducto' => $row[2],
            'DescripcionProducto' => $row[3],
            'Cantidad' => $row[4],
            'Unidades' => $row[5],
            'ValorBruto' => $row[6],
            'Descuento' => $row[7],
            'ValorNeto' => $row[8],
            'Iva' => $row[9],
            'ValorIva' => $row[10],
            'ImpuestoConsumo' => $row[11],
            'TotalItem' => $row[12],
            'Documento' => $row[13],
            'NombreTercero' => $row[14]
        ]);
    }
}
