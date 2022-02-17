<?php

namespace App\Http\Controllers;

use App\Ventas;
use Illuminate\Http\Request;
use App\Imports\VentasImport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Carbon\Carbon;


class VentasController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $id = $request->id;
            $ventas = Ventas::select('ventas.id','ventas.VentaNro',DB::raw('date_add(date("1900-01-01"), interval ventas.Fecha day ) as Fecha '),
            'ventas.CodProducto','ventas.DescripcionProducto','ventas.Cantidad','ventas.Unidades',
            'ventas.ValorBruto','ventas.Descuento','ventas.ValorNeto','ventas.Iva', 'ventas.ValorIva',
            'ventas.ImpuestoConsumo','ventas.TotalItem','ventas.Documento','ventas.NombreTercero')
             ->orderBy('ventas.id', 'asc')->paginate(10);
        }
        else{
            $ventas = Ventas::select('ventas.id','ventas.VentaNro',DB::raw('date_add(date("1900-01-01"), interval ventas.Fecha day ) as Fecha'),
            'ventas.CodProducto','ventas.DescripcionProducto','ventas.Cantidad','ventas.Unidades',
            'ventas.ValorBruto','ventas.Descuento','ventas.ValorNeto','ventas.Iva', 'ventas.ValorIva',
            'ventas.ImpuestoConsumo','ventas.TotalItem','ventas.Documento','ventas.NombreTercero')
            ->where('ventas.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('ventas.id', 'asc')->paginate(10);
        }
        
        return [
            'pagination' => [
                'total'        => $ventas->total(),
                'current_page' => $ventas->currentPage(),
                'per_page'     => $ventas->perPage(),
                'last_page'    => $ventas->lastPage(),
                'from'         => $ventas->firstItem(),
                'to'           => $ventas->lastItem(),
            ],
            'ventas' => $ventas
        ];
    }
    
    public function listarPdf(){
        $ahora= Carbon::now('America/Bogota');
        $ventas = Ventas::select('ventas.id','ventas.VentaNro',DB::raw('date_add(date("1900-01-01"), interval ventas.Fecha day ) as Fecha '),
        'ventas.CodProducto','ventas.DescripcionProducto','ventas.Cantidad','ventas.Unidades',
        'ventas.ValorBruto','ventas.Descuento','ventas.ValorNeto','ventas.Iva', 'ventas.ValorIva',
        'ventas.ImpuestoConsumo','ventas.TotalItem','ventas.Documento','ventas.NombreTercero')
        ->orderBy('ventas.id', 'desc')->get();
        $cont=Ventas::count();

        $pdf = \PDF::loadView('pdf.ventas',['ventas'=>$ventas,'cont'=>$cont,'ahora'=>$ahora])->setPaper('a4', 'landscape');
        return $pdf->download('ventas.pdf');
    }

    public function listarPdfDiario(){
        
        $ahora= Carbon::now('America/Bogota');
        $today= Carbon::now('America/Bogota')->toDateString();

        $tomorrow= new Carbon('tomorrow');

        $ventas = Ventas::select('ventas.id','ventas.VentaNro',DB::raw('date_add(date("1900-01-01"), interval ventas.Fecha day ) as Fecha '),
        'ventas.CodProducto','ventas.DescripcionProducto','ventas.Cantidad','ventas.Unidades',
        'ventas.ValorBruto','ventas.Descuento','ventas.ValorNeto','ventas.Iva', 'ventas.ValorIva',
        'ventas.ImpuestoConsumo','ventas.TotalItem','ventas.Documento','ventas.NombreTercero')
        ->whereBetween('Fecha',[$today,$tomorrow])
        ->orderBy('ventas.id', 'desc')->get();
        $cont=count($ventas);

        $pdf = \PDF::loadView('pdf.ventas',['ventas'=>$ventas,'cont'=>$cont,'ahora'=>$ahora])->setPaper('a4', 'landscape');
        return $pdf->download('ventas'.$today.'.pdf');
    }

    public function excel(){
        
        $ventas = Ventas::select('ventas.id','ventas.VentaNro',DB::raw('date_add(date("1900-01-01"), interval ventas.Fecha day ) as Fecha '),
        'ventas.CodProducto','ventas.DescripcionProducto','ventas.Cantidad','ventas.Unidades',
        'ventas.ValorBruto','ventas.Descuento','ventas.ValorNeto','ventas.Iva', 'ventas.ValorIva',
        'ventas.ImpuestoConsumo','ventas.TotalItem','ventas.Documento','ventas.NombreTercero')
        ->orderBy('ventas.id', 'desc')->get();
        return [
            'ventas' => $ventas
        ];
        
    }


    public function import(Request $request)
    {
         $request->validate([
            'import_file' => 'required|file|mimes:xls,xlsx'
        ]);

        $path = $request->file('import_file')->store('temp');
        $data = Excel::import(new VentasImport, $path);

        return response()->json(['message' => $path], 200);
    }
}
