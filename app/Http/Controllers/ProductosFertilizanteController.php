<?php

namespace App\Http\Controllers;
use App\ProductosFertilizante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductosFertilizanteController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar == ''){
            $fertilizantes = ProductosFertilizante::select('id','nombre')
            ->orderBy('id','asc')->paginate(20);
        }
        else{
            $fertilizantes = ProductosFertilizante::select('id','nombre')
            ->where('productosfertilizantes.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('productosfertilizantes.id', 'desc')->paginate(20);
        }
        return [
            'pagination' => [
                'total'        => $fertilizantes->total(),
                'current_page' => $fertilizantes->currentPage(),
                'per_page'     => $fertilizantes->perPage(),
                'last_page'    => $fertilizantes->lastPage(),
                'from'         => $fertilizantes->firstItem(),
                'to'           => $fertilizantes->lastItem(),
            ],
            'fertilizantes'=>$fertilizantes
        ];
    }

    public function store(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');

        try{
        DB::beginTransaction();
        $fertilizantes = new ProductosFertilizante();
        $fertilizantes->nombre = $request->nombre;
        $fertilizantes->save();

        DB::commit();
        } catch(Exception $e){
            DB::rollBack();
        }
    }

    public function SelectFertilizante(Request $request){
        // if(!$request->ajax()) return redirect('/');
         $fertilizantes= ProductosFertilizante::select('id','nombre')
         //->where('productor_id','=',$id)
         ->orderBy('id','asc')->get();
         return['fertilizantes'=>$fertilizantes];
     }
}
