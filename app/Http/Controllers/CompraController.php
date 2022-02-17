<?php

namespace App\Http\Controllers;

use App\Compras;
use Illuminate\Http\Request;
use App\Imports\ComprasImport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Carbon\Carbon;



class CompraController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $id = $request->id;
            $compras = Compras::select('compras.id','compras.CompraNro',DB::raw('date_add(date("1900-01-01"), interval compras.Fecha day ) as Fecha '),
            'compras.CodProducto','compras.DescripcionProducto','compras.Cantidad','compras.Unidades',
            'compras.ValorBruto','compras.Descuento','compras.ValorNeto','compras.Iva', 'compras.ValorIva',
            'compras.ImpuestoConsumo','compras.TotalItem','compras.Documento','compras.NombreTercero')
             ->orderBy('compras.id', 'asc')->paginate(10);
        }
        else{
            $compras = Compras::select('compras.id','compras.CompraNro',DB::raw('date_add(date("1900-01-01"), interval compras.Fecha day ) as Fecha '),
            'compras.CodProducto','compras.DescripcionProducto','compras.Cantidad','compras.Unidades',
            'compras.ValorBruto','compras.Descuento','compras.ValorNeto','compras.Iva', 'compras.ValorIva',
            'compras.ImpuestoConsumo','compras.TotalItem','compras.Documento','compras.NombreTercero')
            ->where('compras.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('compras.id', 'asc')->paginate(10);
        }
        
        return [
            'pagination' => [
                'total'        => $compras->total(),
                'current_page' => $compras->currentPage(),
                'per_page'     => $compras->perPage(),
                'last_page'    => $compras->lastPage(),
                'from'         => $compras->firstItem(),
                'to'           => $compras->lastItem(),
            ],
            'compras' => $compras
        ];
    }

    public function listarPdf(){
        $ahora= Carbon::now('America/Bogota');
        $compras = Compras::select('compras.id','compras.CompraNro',DB::raw('date_add(date("1900-01-01"), interval compras.Fecha day ) as Fecha '),
        'compras.CodProducto','compras.DescripcionProducto','compras.Cantidad','compras.Unidades',
        'compras.ValorBruto','compras.Descuento','compras.ValorNeto','compras.Iva', 'compras.ValorIva',
        'compras.ImpuestoConsumo','compras.TotalItem','compras.Documento','compras.NombreTercero')
        ->orderBy('compras.id', 'asc')->paginate(10);
        $cont=Compras::count();

        $pdf = \PDF::loadView('pdf.compras',['compras'=>$compras,'cont'=>$cont,'ahora'=>$ahora])->setPaper('a4', 'landscape');
        return $pdf->download('compras.pdf');
    }

    public function listarPdfDiario(){
        
        $ahora= Carbon::now('America/Bogota');
        $today= Carbon::now('America/Bogota')->toDateString();

        $tomorrow= new Carbon('tomorrow');

        $compras = Compras::select('compras.id','compras.CompraNro',DB::raw('date_add(date("1900-01-01"), interval compras.Fecha day ) as Fecha '),
        'compras.CodProducto','compras.DescripcionProducto','compras.Cantidad','compras.Unidades',
        'compras.ValorBruto','compras.Descuento','compras.ValorNeto','compras.Iva', 'compras.ValorIva',
        'compras.ImpuestoConsumo','compras.TotalItem','compras.Documento','compras.NombreTercero')    
        ->whereBetween('Fecha',[$today,$tomorrow])
        ->orderBy('compras.id', 'asc')->paginate(10);
        $cont=count($compras);

        $pdf = \PDF::loadView('pdf.compras',['compras'=>$compras,'cont'=>$cont,'ahora'=>$ahora])->setPaper('a4', 'landscape');
        return $pdf->download('compras'.$today.'.pdf');
    }

    public function excel(){
        
        $compras = Compras::select('compras.id','compras.CompraNro',DB::raw('date_add(date("1900-01-01"), interval compras.Fecha day ) as Fecha '),
        'compras.CodProducto','compras.DescripcionProducto','compras.Cantidad','compras.Unidades',
        'compras.ValorBruto','compras.Descuento','compras.ValorNeto','compras.Iva', 'compras.ValorIva',
        'compras.ImpuestoConsumo','compras.TotalItem','compras.Documento','compras.NombreTercero')   
        ->orderBy('compras.id', 'desc')->get();
        return [
            'compras' => $compras
        ];
        
    }
    
    public function import(Request $request)
    {
         $request->validate([
            'import_file' => 'required|file|mimes:xls,xlsx'
        ]);

        $path = $request->file('import_file')->store('temp');
        $data = Excel::import(new ComprasImport, $path);

        return response()->json(['message' => $path], 200);
    }
}
