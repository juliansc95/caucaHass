<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\PredioCultivo;

class PredioCultivoController extends Controller
{
    public function index(Request $request)
    {
    //if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar == ''){
            $predios= PredioCultivo::join('personas','predioCultivos.productor_id','=','personas.id')
            ->join('productors','predioCultivos.productor_id','=','productors.id')
            ->join('fincas','predioCultivos.finca_id','=','fincas.id')
            ->join('veredas','predioCultivos.vereda_id','=','veredas.id')
            ->select('personas.nombre','predioCultivos.productor_id','predioCultivos.finca_id','fincas.nombre as nombre_finca',
            'predioCultivos.areaSembradaPredio','predioCultivos.fechaSiembra','predioCultivos.numeroPlantasTotales','predioCultivos.numeroPlantasProduccion',
            'predioCultivos.plantasErradicadas','predioCultivos.plantasLevante','predioCultivos.TipoMora','predioCultivos.vereda_id','veredas.nombre as nombre_vereda',
            'predioCultivos.tipoReproduccion','predioCultivos.bolsa')
            ->orderBy('predioCultivos.id','desc')->paginate(3);
        }
        if($criterio == 'personas'){
            $predios= PredioCultivo::join('personas','predioCultivos.productor_id','=','personas.id')
            ->join('productors','predioCultivos.productor_id','=','productors.id')
            ->join('fincas','predioCultivos.finca_id','=','fincas.id')
            ->join('veredas','predioCultivos.vereda_id','=','veredas.id')
            ->select('personas.nombre','predioCultivos.productor_id','predioCultivos.finca_id','fincas.nombre as nombre_finca',
            'predioCultivos.areaSembradaPredio','predioCultivos.fechaSiembra','predioCultivos.numeroPlantasTotales','predioCultivos.numeroPlantasProduccion',
            'predioCultivos.plantasErradicadas','predioCultivos.plantasLevante','predioCultivos.TipoMora','predioCultivos.vereda_id','veredas.nombre as nombre_vereda',
            'predioCultivos.tipoReproduccion','predioCultivos.bolsa')
            ->where($criterio.'.nombre', 'like', '%'. $buscar . '%')
            ->orderBy('predioCultivos.id', 'asc')->paginate(3);
            }
        else{
            $predios= PredioCultivo::join('personas','predioCultivos.productor_id','=','personas.id')
            ->join('productors','predioCultivos.productor_id','=','productors.id')
            ->join('fincas','predioCultivos.finca_id','=','fincas.id')
            ->join('veredas','predioCultivos.vereda_id','=','veredas.id')
            ->select('personas.nombre','predioCultivos.productor_id','predioCultivos.finca_id','fincas.nombre as nombre_finca',
            'predioCultivos.areaSembradaPredio','predioCultivos.fechaSiembra','predioCultivos.numeroPlantasTotales','predioCultivos.numeroPlantasProduccion',
            'predioCultivos.plantasErradicadas','predioCultivos.plantasLevante','predioCultivos.TipoMora','predioCultivos.vereda_id','veredas.nombre as nombre_vereda',
            'predioCultivos.tipoReproduccion','predioCultivos.bolsa')
            ->where('predioCultivos.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('predioCultivos.id', 'desc')->paginate(3);
        }
        return [
            'pagination' => [
                'total'        => $predios->total(),
                'current_page' => $predios->currentPage(),
                'per_page'     => $predios->perPage(),
                'last_page'    => $predios->lastPage(),
                'from'         => $predios->firstItem(),
                'to'           => $predios->lastItem(),
            ],
            'predios' => $predios
        ];
    }
    public function store(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');
        try{
        DB::beginTransaction();
        $predio = new PredioCultivo();
        $predio->productor_id = $request->productor_id;
        $predio->finca_id = $request->finca_id;
        $predio->areaSembradaPredio=$request->areaSembradaPredio;
        $mytime= Carbon::parse($request->fechaSiembra)->toDateString();
        $predio->fechaSiembra=$mytime;
        $predio->numeroPlantasTotales= $request->numeroPlantasTotales;
        $predio->numeroPlantasProduccion= $request->numeroPlantasProduccion;
        $predio->plantasErradicadas= $request->plantasErradicadas;
        $predio->plantasLevante = $request->plantasLevante;
        $predio->TipoMora = $request->TipoMora;
        $predio->vereda_id =  $request->vereda_id;
        $predio->tipoReproduccion =  $request->tipoReproduccion;
        $predio->bolsa =  $request->bolsa;
        $predio->save();
        DB::commit();
        }catch(Exception $e){
            DB::rollback();
        }
    }

    public function listarPdf(Request $request)
    {
        $ahora= Carbon::now('America/Bogota');
        $cont=PredioCultivo::count();    
        $predios= PredioCultivo::join('personas','predioCultivos.productor_id','=','personas.id')
            ->join('productors','predioCultivos.productor_id','=','productors.id')
            ->join('fincas','predioCultivos.finca_id','=','fincas.id')
            ->join('veredas','predioCultivos.vereda_id','=','veredas.id')
            ->select('personas.nombre','predioCultivos.productor_id','predioCultivos.finca_id','fincas.nombre as nombre_finca',
            'predioCultivos.areaSembradaPredio','predioCultivos.fechaSiembra','predioCultivos.numeroPlantasTotales','predioCultivos.numeroPlantasProduccion',
            'predioCultivos.plantasErradicadas','predioCultivos.plantasLevante','predioCultivos.TipoMora','predioCultivos.vereda_id','veredas.nombre as nombre_vereda',
            'predioCultivos.tipoReproduccion','predioCultivos.bolsa')
            ->orderBy('predioCultivos.id','desc')->get();
            $pdf = \PDF::loadView('pdf.predioCultivo',['predios'=>$predios,'cont'=>$cont,'ahora'=>$ahora])->setPaper('a4', 'landscape');
            return $pdf->download('predioCultivo.pdf');
    
    }  

    public function excel(Request $request)
    {   
        $predios= PredioCultivo::join('personas','predioCultivos.productor_id','=','personas.id')
            ->join('productors','predioCultivos.productor_id','=','productors.id')
            ->join('fincas','predioCultivos.finca_id','=','fincas.id')
            ->join('veredas','predioCultivos.vereda_id','=','veredas.id')
            ->select('personas.nombre','predioCultivos.productor_id','predioCultivos.finca_id','fincas.nombre as nombre_finca',
            'predioCultivos.areaSembradaPredio','predioCultivos.fechaSiembra','predioCultivos.numeroPlantasTotales','predioCultivos.numeroPlantasProduccion',
            'predioCultivos.plantasErradicadas','predioCultivos.plantasLevante','predioCultivos.TipoMora','predioCultivos.vereda_id','veredas.nombre as nombre_vereda',
            'predioCultivos.tipoReproduccion','predioCultivos.bolsa')
            ->orderBy('predioCultivos.id','desc')->get();
            return [
                'predios' => $predios
            ];
    
    } 
}
