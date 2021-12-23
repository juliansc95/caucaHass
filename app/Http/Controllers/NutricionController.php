<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Nutricion;
use Carbon\Carbon;

class NutricionController extends Controller
{
    public function index(Request $request)
    {
    if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar == ''){
            $nutricions= Nutricion::join('personas','nutricions.productor_id','=','personas.id')
            ->join('productors','nutricions.productor_id','=','productors.id')
            ->join('fincas','nutricions.finca_id','=','fincas.id')
            ->select('personas.nombre','nutricions.productor_id','nutricions.finca_id','fincas.nombre as nombre_finca',
            'nutricions.analisis','nutricions.fechaAnalisis','nutricions.fertilizaAnalisis','nutricions.aplicacionesCal','nutricions.aplicoSiembraCal',
            'nutricions.dosisAplicacionCal','nutricions.formaAplicacionCal','nutricions.frecuenciaAplicacionCal','nutricions.fechaCal',
            'nutricions.aplicacionesMateriaOrganica','nutricions.aplicoSiembraMateriaOrganica','nutricions.dosisAplicacionMateriaOrganica',
            'nutricions.formaAplicacionMateriaOrganica','nutricions.frecuenciaAplicacionMateriaOrganica',
            'nutricions.fechaMateriaOrganica','nutricions.fechaUltimaFertilizacion','nutricions.formaAplicacionFert','nutricions.frecuenciaAplicacionFert')
            ->orderBy('nutricions.id','desc')->paginate(3);
        }
        if($criterio == 'personas'){
            $nutricions= Nutricion::join('personas','nutricions.productor_id','=','personas.id')
            ->join('productors','nutricions.productor_id','=','productors.id')
            ->join('fincas','nutricions.finca_id','=','fincas.id')
            ->select('personas.nombre','nutricions.productor_id','nutricions.finca_id','fincas.nombre as nombre_finca',
            'nutricions.analisis','nutricions.fechaAnalisis','nutricions.fertilizaAnalisis','nutricions.aplicacionesCal','nutricions.aplicoSiembraCal',
            'nutricions.dosisAplicacionCal','nutricions.formaAplicacionCal','nutricions.frecuenciaAplicacionCal','nutricions.fechaCal',
            'nutricions.aplicacionesMateriaOrganica','nutricions.aplicoSiembraMateriaOrganica','nutricions.dosisAplicacionMateriaOrganica',
            'nutricions.formaAplicacionMateriaOrganica','nutricions.frecuenciaAplicacionMateriaOrganica',
            'nutricions.fechaMateriaOrganica','nutricions.fechaUltimaFertilizacion','nutricions.formaAplicacionFert','nutricions.frecuenciaAplicacionFert')
            ->where($criterio.'.nombre', 'like', '%'. $buscar . '%')
            ->orderBy('nutricions.id', 'asc')->paginate(3);
            }
        else{
            $nutricions= Nutricion::join('personas','nutricions.productor_id','=','personas.id')
            ->join('productors','nutricions.productor_id','=','productors.id')
            ->join('fincas','nutricions.finca_id','=','fincas.id')
            ->select('personas.nombre','nutricions.productor_id','nutricions.finca_id','fincas.nombre as nombre_finca',
            'nutricions.analisis','nutricions.fechaAnalisis','nutricions.fertilizaAnalisis','nutricions.aplicacionesCal','nutricions.aplicoSiembraCal',
            'nutricions.dosisAplicacionCal','nutricions.formaAplicacionCal','nutricions.frecuenciaAplicacionCal','nutricions.fechaCal',
            'nutricions.aplicacionesMateriaOrganica','nutricions.aplicoSiembraMateriaOrganica','nutricions.dosisAplicacionMateriaOrganica',
            'nutricions.formaAplicacionMateriaOrganica','nutricions.frecuenciaAplicacionMateriaOrganica',
            'nutricions.fechaMateriaOrganica','nutricions.fechaUltimaFertilizacion','nutricions.formaAplicacionFert','nutricions.frecuenciaAplicacionFert')
            ->where('nutricions.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('nutricions.id', 'desc')->paginate(3);
        }
        return [
            'pagination' => [
                'total'        => $nutricions->total(),
                'current_page' => $nutricions->currentPage(),
                'per_page'     => $nutricions->perPage(),
                'last_page'    => $nutricions->lastPage(),
                'from'         => $nutricions->firstItem(),
                'to'           => $nutricions->lastItem(),
            ],
            'nutricions' => $nutricions
        ];
    }
    public function store(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');
        try{
        DB::beginTransaction();
        $nutricion = new Nutricion();
        $nutricion->productor_id = $request->productor_id;
        $nutricion->finca_id = $request->finca_id;
        $nutricion->analisis=$request->analisis;
        $mytime= Carbon::parse($request->fechaAnalisis)->toDateString();
        $nutricion->fechaAnalisis= $mytime;
        $nutricion->fertilizaAnalisis=$request->fertilizaAnalisis;
        $nutricion->aplicacionesCal=$request->aplicacionesCal;
        $nutricion->aplicoSiembraCal=$request->aplicoSiembraCal;
        $nutricion->dosisAplicacionCal=$request->dosisAplicacionCal;
        $nutricion->formaAplicacionCal=$request->formaAplicacionCal;
        $nutricion->frecuenciaAplicacionCal=$request->frecuenciaAplicacionCal;
        $cal= Carbon::parse($request->fechaCal)->toDateString();
        $nutricion->fechaCal=$cal;
        $nutricion->aplicacionesMateriaOrganica=$request->aplicacionesMateriaOrganica;
        $nutricion->aplicoSiembraMateriaOrganica=$request->aplicoSiembraMateriaOrganica;
        $nutricion->dosisAplicacionMateriaOrganica=$request->dosisAplicacionMateriaOrganica;
        $nutricion->formaAplicacionMateriaOrganica=$request->formaAplicacionMateriaOrganica;
        $nutricion->frecuenciaAplicacionMateriaOrganica=$request->frecuenciaAplicacionMateriaOrganica;
        $organica= Carbon::parse($request->fechaMateriaOrganica)->toDateString();
        $nutricion->fechaMateriaOrganica=$organica;
        $fertilizacion= Carbon::parse($request->fechaUltimaFertilizacion)->toDateString();
        $nutricion->fechaUltimaFertilizacion= $fertilizacion;
        $nutricion->formaAplicacionFert=$request->formaAplicacionFert;
        $nutricion->frecuenciaAplicacionFert=$request->frecuenciaAplicacionFert;
        $nutricion->save();
        DB::commit();
        }catch(Exception $e){
            DB::rollback();
        }
    }

    public function listarPdf(Request $request)
    {       
        $ahora= Carbon::now('America/Bogota');
        $cont=Nutricion::count();
        $nutricions= Nutricion::join('personas','nutricions.productor_id','=','personas.id')
        ->join('productors','nutricions.productor_id','=','productors.id')
        ->join('fincas','nutricions.finca_id','=','fincas.id')
        ->select('personas.nombre','nutricions.productor_id','nutricions.finca_id','fincas.nombre as nombre_finca',
        'nutricions.analisis','nutricions.fechaAnalisis','nutricions.fertilizaAnalisis','nutricions.aplicacionesCal','nutricions.aplicoSiembraCal',
        'nutricions.dosisAplicacionCal','nutricions.formaAplicacionCal','nutricions.frecuenciaAplicacionCal','nutricions.fechaCal',
        'nutricions.aplicacionesMateriaOrganica','nutricions.aplicoSiembraMateriaOrganica','nutricions.dosisAplicacionMateriaOrganica',
        'nutricions.formaAplicacionMateriaOrganica','nutricions.frecuenciaAplicacionMateriaOrganica',
        'nutricions.fechaMateriaOrganica','nutricions.fechaUltimaFertilizacion','nutricions.formaAplicacionFert','nutricions.frecuenciaAplicacionFert')
        ->orderBy('nutricions.id','desc')->get();
        $pdf = \PDF::loadView('pdf.nutricion',['nutricions'=>$nutricions,'cont'=>$cont,'ahora'=>$ahora])->setPaper('a4', 'landscape');
        return $pdf->download('nutricion.pdf');   
    }

    public function excel(Request $request)
    {       
        $nutricions= Nutricion::join('personas','nutricions.productor_id','=','personas.id')
        ->join('productors','nutricions.productor_id','=','productors.id')
        ->join('fincas','nutricions.finca_id','=','fincas.id')
        ->select('personas.nombre','nutricions.productor_id','nutricions.finca_id','fincas.nombre as nombre_finca',
        'nutricions.analisis','nutricions.fechaAnalisis','nutricions.fertilizaAnalisis','nutricions.aplicacionesCal','nutricions.aplicoSiembraCal',
        'nutricions.dosisAplicacionCal','nutricions.formaAplicacionCal','nutricions.frecuenciaAplicacionCal','nutricions.fechaCal',
        'nutricions.aplicacionesMateriaOrganica','nutricions.aplicoSiembraMateriaOrganica','nutricions.dosisAplicacionMateriaOrganica',
        'nutricions.formaAplicacionMateriaOrganica','nutricions.frecuenciaAplicacionMateriaOrganica',
        'nutricions.fechaMateriaOrganica','nutricions.fechaUltimaFertilizacion','nutricions.formaAplicacionFert','nutricions.frecuenciaAplicacionFert')
        ->orderBy('nutricions.id','desc')->get();
        return [
            'nutricions' => $nutricions
        ];
    }
}
