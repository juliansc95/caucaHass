<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LugarVenta;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class LugarVentaController extends Controller
{
    public function selectLugarVenta(Request $request){
        //if(!$request->ajax()) return redirect('/');
        $lugarVentas = LugarVenta::select('id','nombre')->orderBy('id','asc')->get();
        return['lugarVentas'=>$lugarVentas];
    }

    public function selectLugarVenta2(Request $request){
        //if(!$request->ajax()) return redirect('/');
        $filtro = $request->filtro;
        $lugarVentas = LugarVenta::select('id','nombre')
        ->where('nombre', 'like', '%'. $filtro . '%')
        ->orderBy('nombre', 'asc')->get();
        return['lugarVentas'=>$lugarVentas];
    }

    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar == ''){
            $lugarVentas = LugarVenta::select('id','nombre')
            ->orderBy('id','asc')->paginate(5);
        }
        else{
            $lugarVentas = LugarVenta::select('id','nombre')
            ->where('lugarVentas.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('lugarVentas.id', 'desc')->paginate(5);
        }
        return [
            'pagination' => [
                'total'        => $lugarVentas->total(),
                'current_page' => $lugarVentas->currentPage(),
                'per_page'     => $lugarVentas->perPage(),
                'last_page'    => $lugarVentas->lastPage(),
                'from'         => $lugarVentas->firstItem(),
                'to'           => $lugarVentas->lastItem(),
            ],
            'lugarVentas'=>$lugarVentas
        ];
    }

    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');

        try{
        DB::beginTransaction();
        $lugarVenta = new LugarVenta();
        $lugarVenta->nombre = $request->nombre;
        $lugarVenta->save();

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

        $lugarVenta= LugarVenta::findOrFail($request->id);
        $lugarVenta->nombre = $request->nombre;
        $lugarVenta->save();
        DB::commit();
        }catch(Exception $e){
            DB::rollback();
        }
    }

    public function listarPdf(Request $request)
    {
        $ahora= Carbon::now('America/Bogota');    
        $lugarVentas = LugarVenta::select('id','nombre')
        ->orderBy('id','asc')->get();
        $cont=LugarVenta::count();

        $pdf = \PDF::loadView('pdf.lugarVenta',['lugarVentas'=>$lugarVentas,'cont'=>$cont,'ahora'=>$ahora])->setPaper('a4', 'landscape');
        return $pdf->download('lugarVenta.pdf');
        
    }

    public function excel(Request $request)
    {    
        $lugarVentas = LugarVenta::select('id','nombre')
        ->orderBy('id','asc')->get();
        return [
            'lugarVentas'=>$lugarVentas
        ];
    }

}
