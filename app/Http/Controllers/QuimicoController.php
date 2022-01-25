<?php

namespace App\Http\Controllers;
use App\Quimico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class QuimicoController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar == ''){
            $quimicos = Quimico::select('id','nombre')
            ->orderBy('id','asc')->paginate(20);
        }
        else{
            $quimicos = Quimico::select('id','nombre')
            ->where('quimicos.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('quimicos.id', 'desc')->paginate(20);
        }
        return [
            'pagination' => [
                'total'        => $quimicos->total(),
                'current_page' => $quimicos->currentPage(),
                'per_page'     => $quimicos->perPage(),
                'last_page'    => $quimicos->lastPage(),
                'from'         => $quimicos->firstItem(),
                'to'           => $quimicos->lastItem(),
            ],
            'quimicos'=>$quimicos
        ];
    }

    public function store(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');

        try{
        DB::beginTransaction();
        $quimicos = new Quimico();
        $quimicos->nombre = $request->nombre;
        $quimicos->save();

        DB::commit();
        } catch(Exception $e){
            DB::rollBack();
        }
    }

    public function SelectQuimico(Request $request){
        // if(!$request->ajax()) return redirect('/');
         $quimicos= Quimico::select('id','nombre')
         //->where('productor_id','=',$id)
         ->orderBy('id','asc')->get();
         return['quimicos'=>$quimicos];
     }
}
