<?php

namespace App\Http\Controllers;
use App\ProductoFitosanitario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class ProductoFitosanitarioController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar == ''){
            $productoFitosanitarios = ProductoFitosanitario::select('id','nombre')
            ->orderBy('id','asc')->paginate(20);
        }
        else{
            $productoFitosanitarios = ProductoFitosanitario::select('id','nombre')
            ->where('productoFitosanitarios.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('productoFitosanitarios.id', 'desc')->paginate(20);
        }
        return [
            'pagination' => [
                'total'        => $productoFitosanitarios->total(),
                'current_page' => $productoFitosanitarios->currentPage(),
                'per_page'     => $productoFitosanitarios->perPage(),
                'last_page'    => $productoFitosanitarios->lastPage(),
                'from'         => $productoFitosanitarios->firstItem(),
                'to'           => $productoFitosanitarios->lastItem(),
            ],
            'productoFitosanitarios'=>$productoFitosanitarios
        ];
    }

    public function store(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');

        try{
        DB::beginTransaction();
        $productoFitosanitario = new ProductoFitosanitario();
        $productoFitosanitario->nombre = $request->nombre;
        $productoFitosanitario->save();

        DB::commit();
        } catch(Exception $e){
            DB::rollBack();
        }
    }

    public function update(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        try{
        DB::beginTransaction();

        $productoFitosanitario= ProductoFitosanitario::findOrFail($request->id);
        $productoFitosanitario->nombre = $request->nombre;
        $productoFitosanitario->save();
        DB::commit();
        }catch(Exception $e){
            DB::rollback();
        }
    }

    public function listarPdf(Request $request)
    {
        $ahora= Carbon::now('America/Bogota');
        $productoFitosanitarios = ProductoFitosanitario::select('id','nombre')
        ->orderBy('id','asc')->get();
        $cont=ProductoFitosanitario::count();

        $pdf = \PDF::loadView('pdf.producto',['productoFitosanitarios'=>$productoFitosanitarios,'cont'=>$cont,'ahora'=>$ahora])->setPaper('a4', 'landscape');
        return $pdf->download('producto.pdf');
        
    }

    public function excel(Request $request)
    {
        $productoFitosanitarios = ProductoFitosanitario::select('id','nombre')
        ->orderBy('id','asc')->get();
        return [
            'productoFitosanitarios'=>$productoFitosanitarios
        ];
    }
}
