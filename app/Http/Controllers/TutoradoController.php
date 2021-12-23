<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Tutorado;
use Carbon\Carbon;


class TutoradoController extends Controller
{
    public function index(Request $request)
    {
    if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar == ''){
            $tutorados= Tutorado::join('personas','tutorados.productor_id','=','personas.id')
            ->join('productors','tutorados.productor_id','=','productors.id')
            ->join('fincas','tutorados.finca_id','=','fincas.id')
            ->select('personas.nombre','tutorados.productor_id','tutorados.finca_id','fincas.nombre as nombre_finca',
            'tutorados.tutorado','tutorados.tipoTutorado','tutorados.tipoMadera')
            ->orderBy('tutorados.id','desc')->paginate(3);
        }
        if($criterio == 'personas'){
            $tutorados= Tutorado::join('personas','tutorados.productor_id','=','personas.id')
            ->join('productors','tutorados.productor_id','=','productors.id')
            ->join('fincas','tutorados.finca_id','=','fincas.id')
            ->select('personas.nombre','tutorados.productor_id','tutorados.finca_id','fincas.nombre as nombre_finca',
            'tutorados.tutorado','tutorados.tipoTutorado','tutorados.tipoMadera')
            ->where($criterio.'.nombre', 'like', '%'. $buscar . '%')
            ->orderBy('tutorados.id', 'asc')->paginate(3);
            }
        else{
            $tutorados= Tutorado::join('personas','tutorados.productor_id','=','personas.id')
            ->join('productors','tutorados.productor_id','=','productors.id')
            ->join('fincas','tutorados.finca_id','=','fincas.id')
            ->select('personas.nombre','tutorados.productor_id','tutorados.finca_id','fincas.nombre as nombre_finca',
            'tutorados.tutorado','tutorados.tipoTutorado','tutorados.tipoMadera')
            ->where('tutorados.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('tutorados.id', 'desc')->paginate(3);
        }
        return [
            'pagination' => [
                'total'        => $tutorados->total(),
                'current_page' => $tutorados->currentPage(),
                'per_page'     => $tutorados->perPage(),
                'last_page'    => $tutorados->lastPage(),
                'from'         => $tutorados->firstItem(),
                'to'           => $tutorados->lastItem(),
            ],
            'tutorados' => $tutorados
        ];
    }
    public function store(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');
        try{
        DB::beginTransaction();
        $tutorado = new Tutorado();
        $tutorado->productor_id = $request->productor_id;
        $tutorado->finca_id = $request->finca_id;
        $tutorado->tutorado=$request->tutorado;
        $tutorado->tipoTutorado=$request->tipoTutorado;
        $tutorado->tipoMadera= $request->tipoMadera;
        $tutorado->save();
        DB::commit();
        }catch(Exception $e){
            DB::rollback();
        }
    }

    public function listarPdf(Request $request)
    {
        $ahora= Carbon::now('America/Bogota');
        $cont=Tutorado::count();
        $tutorados= Tutorado::join('personas','tutorados.productor_id','=','personas.id')
        ->join('productors','tutorados.productor_id','=','productors.id')
        ->join('fincas','tutorados.finca_id','=','fincas.id')
        ->select('personas.nombre','tutorados.productor_id','tutorados.finca_id','fincas.nombre as nombre_finca',
        'tutorados.tutorado','tutorados.tipoTutorado','tutorados.tipoMadera')
        ->orderBy('tutorados.id','desc')->get();
        $pdf = \PDF::loadView('pdf.tutorado',['tutorados'=>$tutorados,'cont'=>$cont,'ahora'=>$ahora])->setPaper('a4', 'landscape');
        return $pdf->download('tutorado.pdf');     
    }

    public function excel(Request $request)
    {
        $tutorados= Tutorado::join('personas','tutorados.productor_id','=','personas.id')
        ->join('productors','tutorados.productor_id','=','productors.id')
        ->join('fincas','tutorados.finca_id','=','fincas.id')
        ->select('personas.nombre','tutorados.productor_id','tutorados.finca_id','fincas.nombre as nombre_finca',
        'tutorados.tutorado','tutorados.tipoTutorado','tutorados.tipoMadera')
        ->orderBy('tutorados.id','desc')->get();
        return [
            'tutorados' => $tutorados
        ];
    }    
}
