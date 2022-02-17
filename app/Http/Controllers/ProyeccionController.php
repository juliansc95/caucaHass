<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Proyeccion;

class ProyeccionController extends Controller
{
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar == ''){
            $proyeccions= Proyeccion::
            join('productors','proyeccions.productor_id','=','productors.id')
            ->join('personas','proyeccions.productor_id','=','personas.id')
            ->join('fincas','proyeccions.finca_id','=','fincas.id')
            ->select('proyeccions.id','proyeccions.productor_id','proyeccions.finca_id',
            'proyeccions.arbolesLoteUno','proyeccions.EdadArbolesLoteUno','proyeccions.kgProyectadoLoteUno',
            'proyeccions.arbolesLoteDos','proyeccions.EdadArbolesLoteDos','proyeccions.kgProyectadoLoteDos',
            'personas.nombre as nombre_productor','fincas.nombre as nombre_finca'
            )
            ->orderBy('proyeccions.id','desc')->paginate(10);
        }
        else{
            $proyeccions= Proyeccion::
            join('productors','proyeccions.productor_id','=','productors.id')
            ->join('personas','proyeccions.productor_id','=','personas.id')
            ->join('fincas','proyeccions.finca_id','=','fincas.id')
            ->select('proyeccions.id','proyeccions.productor_id','proyeccions.finca_id',
            'proyeccions.arbolesLoteUno','proyeccions.EdadArbolesLoteUno','proyeccions.kgProyectadoLoteUno',
            'proyeccions.arbolesLoteDos','proyeccions.EdadArbolesLoteDos','proyeccions.kgProyectadoLoteDos',
            'personas.nombre as nombre_productor','fincas.nombre as nombre_finca'
            )
            ->where('proyeccions.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('proyeccions.id', 'desc')->paginate(10);
        }
        return [
            'pagination' => [
                'total'        => $proyeccions->total(),
                'current_page' => $proyeccions->currentPage(),
                'per_page'     => $proyeccions->perPage(),
                'last_page'    => $proyeccions->lastPage(),
                'from'         => $proyeccions->firstItem(),
                'to'           => $proyeccions->lastItem(),
            ],
            'proyeccions' => $proyeccions
        ];
    }

    public function store(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');
        try{
            DB::beginTransaction();
            $proyeccion = new Proyeccion();
            $proyeccion->productor_id = $request->productor_id;
            $proyeccion->finca_id = $request->finca_id;
            $proyeccion->arbolesLoteUno = $request->arbolesLoteUno;
            $proyeccion->EdadArbolesLoteUno = $request->EdadArbolesLoteUno;
            $proyeccion->kgProyectadoLoteUno = $request->kgProyectadoLoteUno;
            $proyeccion->arbolesLoteDos = $request->arbolesLoteDos;
            $proyeccion->EdadArbolesLoteDos = $request->EdadArbolesLoteDos;
            $proyeccion->kgProyectadoLoteDos = $request->kgProyectadoLoteDos;
            $proyeccion->save();
            DB::commit();
        }catch(Exception $e){
            DB::rollback();
        }
    }

    public function update(Request $request)
    {
        if(!$request->ajax()) return redirect('/');

        $proyeccion =Proyeccion::findOrFail($request->id);
        $proyeccion->productor_id = $request->productor_id;
        $proyeccion->finca_id = $request->finca_id;
        $proyeccion->arbolesLoteUno = $request->arbolesLoteUno;
        $proyeccion->EdadArbolesLoteUno = $request->EdadArbolesLoteUno;
        $proyeccion->kgProyectadoLoteUno = $request->kgProyectadoLoteUno;
        $proyeccion->arbolesLoteDos = $request->arbolesLoteDos;
        $proyeccion->EdadArbolesLoteDos = $request->EdadArbolesLoteDos;
        $proyeccion->kgProyectadoLoteDos = $request->kgProyectadoLoteDos;
        $proyeccion->save();
    }


    public function listarPdf(Request $request)
    {
        $ahora= Carbon::now('America/Bogota');    
        $proyeccions= Proyeccion::
        join('productors','proyeccions.productor_id','=','productors.id')
        ->join('personas','proyeccions.productor_id','=','personas.id')
        ->join('fincas','proyeccions.finca_id','=','fincas.id')
        ->select('proyeccions.id','proyeccions.productor_id','proyeccions.finca_id',
        'proyeccions.arbolesLoteUno','proyeccions.EdadArbolesLoteUno','proyeccions.kgProyectadoLoteUno',
        'proyeccions.arbolesLoteDos','proyeccions.EdadArbolesLoteDos','proyeccions.kgProyectadoLoteDos',
        'personas.nombre as nombre_productor','fincas.nombre as nombre_finca'
        )
        ->orderBy('proyeccions.id','desc')->get();
        $cont=Proyeccion::count();

        $pdf = \PDF::loadView('pdf.proyeccions',['proyeccions'=>$proyeccions,'cont'=>$cont,'ahora'=>$ahora])->setPaper('a4', 'landscape');
        return $pdf->download('proyeccions.pdf');  
    }

    public function excel(Request $request)
    {    
        $proyeccions= Proyeccion::
        join('productors','proyeccions.productor_id','=','productors.id')
        ->join('personas','proyeccions.productor_id','=','personas.id')
        ->join('fincas','proyeccions.finca_id','=','fincas.id')
        ->select('proyeccions.id','proyeccions.productor_id','proyeccions.finca_id',
        'proyeccions.arbolesLoteUno','proyeccions.EdadArbolesLoteUno','proyeccions.kgProyectadoLoteUno',
        'proyeccions.arbolesLoteDos','proyeccions.EdadArbolesLoteDos','proyeccions.kgProyectadoLoteDos',
        'personas.nombre as nombre_productor','fincas.nombre as nombre_finca'
        )
            ->orderBy('proyeccions.id','desc')->get();
            return [
                'proyeccions' => $proyeccions
            ];
    }
}
