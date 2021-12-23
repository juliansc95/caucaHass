<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategoriaMora;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CategoriaMoraController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar == ''){
            $categoriaMoras= CategoriaMora::select('id','nombre','valorUnitario','ValorDonacion','valorTransporte',
            'valorAsohof','valorCuatroPorMil')
            ->orderBy('id','desc')->paginate(3);
        }
        else{
            $categoriaMoras= CategoriaMora::select('id','nombre','valorUnitario','ValorDonacion','valorTransporte',
            'valorAsohof','valorCuatroPorMil')
            ->where('categoriaMoras.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('categoriaMoras.id', 'desc')->paginate(3);          
        }
        return [
            'pagination' => [
                'total'        => $categoriaMoras->total(),
                'current_page' => $categoriaMoras->currentPage(),
                'per_page'     => $categoriaMoras->perPage(),
                'last_page'    => $categoriaMoras->lastPage(),
                'from'         => $categoriaMoras->firstItem(),
                'to'           => $categoriaMoras->lastItem(),
            ],
            'categoriaMoras' => $categoriaMoras
        ];
    }

    public function buscarCategoria(Request $request){ 
        if(!$request->ajax()) return redirect('/');
        $filtro = $request->filtro;
        $categoriaMoras= CategoriaMora::where('id','=',$filtro)
        ->select('id','nombre','valorUnitario','ValorDonacion','valorTransporte',
        'valorAsohof','valorCuatroPorMil')
        ->orderBy('nombre','asc')
        ->take(1)->get();
        

        return[ 'categoriaMoras' => $categoriaMoras];
    }


    public function listarCategoria(Request $request){
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $categoriaMoras= CategoriaMora::select('id','nombre','valorUnitario','ValorDonacion','valorTransporte',
            'valorAsohof','valorCuatroPorMil')
            ->orderBy('id', 'desc')->paginate(10);
        }
        else{
            $categoriaMoras= CategoriaMora::select('id','nombre','valorUnitario','ValorDonacion','valorTransporte',
            'valorAsohof','valorCuatroPorMil')
            ->where('categoriaMoras.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('categoriaMoras.id', 'desc')->paginate(10);
        }
        

        return ['categoriaMoras' => $categoriaMoras];
    }

    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');

        try{
        DB::beginTransaction();    
        $categoriaMora = new CategoriaMora();
        $categoriaMora->nombre = $request->nombre;
        $categoriaMora->valorUnitario = $request->valorUnitario;
        $categoriaMora->valorDonacion = $request->valorDonacion;
        $categoriaMora->valorTransporte = $request->valorTransporte;
        $categoriaMora->valorAsohof = $request->valorAsohof;
        $categoriaMora->valorCuatroPorMil = $request->valorCuatroPorMil;
        $categoriaMora->save();

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

        $categoriaMora= CategoriaMora::findOrFail($request->id);    
        $categoriaMora->nombre = $request->nombre;
        $categoriaMora->valorUnitario = $request->valorUnitario;
        $categoriaMora->valorDonacion = $request->valorDonacion;
        $categoriaMora->valorTransporte = $request->valorTransporte;
        $categoriaMora->valorAsohof = $request->valorAsohof;
        $categoriaMora->valorCuatroPorMil = $request->valorCuatroPorMil;
        $categoriaMora->save();
        DB::commit();    
        }catch(Exception $e){
            DB::rollback();
        }
    }

    public function listarPdf(Request $request)
    {
        $ahora= Carbon::now('America/Bogota');
        $categoriaMoras= CategoriaMora::select('id','nombre','valorUnitario','ValorDonacion','valorTransporte',
        'valorAsohof','valorCuatroPorMil')
        ->orderBy('id','asc')->get();
        $cont=CategoriaMora::count();

        $pdf = \PDF::loadView('pdf.mora',['categoriaMoras'=>$categoriaMoras,'cont'=>$cont,'ahora'=>$ahora])->setPaper('a4', 'landscape');
        return $pdf->download('mora.pdf');
    }

    public function excel(Request $request)
    {
        $categoriaMoras= CategoriaMora::select('id','nombre','valorUnitario','ValorDonacion','valorTransporte',
        'valorAsohof','valorCuatroPorMil')
        ->orderBy('id','asc')->get();
        return [
            'categoriaMoras' => $categoriaMoras
        ];
        
    }

}
