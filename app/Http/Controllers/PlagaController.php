<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Plaga;


class PlagaController extends Controller
{
    public function index(Request $request)
    {
    if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar == ''){
            $plagas= Plaga::join('personas','plagas.productor_id','=','personas.id')
            ->join('productors','plagas.productor_id','=','productors.id')
            ->join('fincas','plagas.finca_id','=','fincas.id')
            ->select('personas.nombre','plagas.productor_id','plagas.finca_id','fincas.nombre as nombre_finca',
            'plagas.monitoreo','plagas.frecuenciaMonitoreo','plagas.perlaTierra','plagas.tipoManejoPerla','plagas.frecuenciaAplicacionPerla',
            'plagas.barrenadorCultivo','plagas.tipoManejoBarrenador','plagas.frecuenciaAplicacionPerla','plagas.barrenadorCultivo',
            'plagas.tipoManejoBarrenador','plagas.frecuenciaAplicacionBarrenador','plagas.tripsCultivo','plagas.tipoManejoTrips',
            'plagas.frecuenciaAplicacionTrips',
            'plagas.afidiosCultivos','plagas.tipoManejoAfidios','plagas.frecuenciaAplicacionAfidios','plagas.acarosCultivos',
            'plagas.tipoManejoAcaros','plagas.frecuenciaAplicacionAcaros','plagas.cochinillaCultivos','plagas.tipoManejoCochinilla',
            'plagas.frecuenciaAplicacionCochinilla')
            ->orderBy('plagas.id','desc')->paginate(3);
        }
        if($criterio == 'personas'){
            $plagas= Plaga::join('personas','plagas.productor_id','=','personas.id')
            ->join('productors','plagas.productor_id','=','productors.id')
            ->join('fincas','plagas.finca_id','=','fincas.id')
            ->select('personas.nombre','plagas.productor_id','plagas.finca_id','fincas.nombre as nombre_finca',
            'plagas.monitoreo','plagas.frecuenciaMonitoreo','plagas.perlaTierra','plagas.tipoManejoPerla','plagas.frecuenciaAplicacionPerla',
            'plagas.barrenadorCultivo','plagas.tipoManejoBarrenador','plagas.frecuenciaAplicacionPerla','plagas.barrenadorCultivo',
            'plagas.tipoManejoBarrenador','plagas.frecuenciaAplicacionBarrenador','plagas.tripsCultivo','plagas.tipoManejoTrips',
            'plagas.afidiosCultivos','plagas.tipoManejoAfidios','plagas.frecuenciaAplicacionAfidios','plagas.acarosCultivos',
            'plagas.tipoManejoAcaros','plagas.frecuenciaAplicacionAcaros','plagas.cochinillaCultivos','plagas.tipoManejoCochinilla',
            'plagas.frecuenciaAplicacionCochinilla','plagas.frecuenciaAplicacionTrips')
            ->where($criterio.'.nombre', 'like', '%'. $buscar . '%')
            ->orderBy('plagas.id', 'asc')->paginate(3);
            }
        else{
            $plagas= Plaga::join('personas','plagas.productor_id','=','personas.id')
            ->join('productors','plagas.productor_id','=','productors.id')
            ->join('fincas','plagas.finca_id','=','fincas.id')
            ->select('personas.nombre','plagas.productor_id','plagas.finca_id','fincas.nombre as nombre_finca',
            'plagas.monitoreo','plagas.frecuenciaMonitoreo','plagas.perlaTierra','plagas.tipoManejoPerla','plagas.frecuenciaAplicacionPerla',
            'plagas.barrenadorCultivo','plagas.tipoManejoBarrenador','plagas.frecuenciaAplicacionPerla','plagas.barrenadorCultivo',
            'plagas.tipoManejoBarrenador','plagas.frecuenciaAplicacionBarrenador','plagas.tripsCultivo','plagas.tipoManejoTrips',
            'plagas.afidiosCultivos','plagas.tipoManejoAfidios','plagas.frecuenciaAplicacionAfidios','plagas.acarosCultivos',
            'plagas.tipoManejoAcaros','plagas.frecuenciaAplicacionAcaros','plagas.cochinillaCultivos','plagas.tipoManejoCochinilla',
            'plagas.frecuenciaAplicacionCochinilla','plagas.frecuenciaAplicacionTrips')
            ->where('plagas.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('plagas.id', 'desc')->paginate(3);
        }
        return [
            'pagination' => [
                'total'        => $plagas->total(),
                'current_page' => $plagas->currentPage(),
                'per_page'     => $plagas->perPage(),
                'last_page'    => $plagas->lastPage(),
                'from'         => $plagas->firstItem(),
                'to'           => $plagas->lastItem(),
            ],
            'plagas' => $plagas
        ];
    }
    public function store(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');
        try{
        DB::beginTransaction();
        $plagas = new Plaga();
        $plagas->productor_id = $request->productor_id;
        $plagas->finca_id = $request->finca_id;
        $plagas->monitoreo=$request->monitoreo;
        $plagas->frecuenciaMonitoreo=$request->frecuenciaMonitoreo;
        $plagas->perlaTierra=$request->perlaTierra;
        $plagas->tipoManejoPerla=$request->tipoManejoPerla;
        $plagas->frecuenciaAplicacionPerla=$request->frecuenciaAplicacionPerla;
        $plagas->barrenadorCultivo=$request->barrenadorCultivo;
        $plagas->tipoManejoBarrenador=$request->tipoManejoBarrenador;
        $plagas->frecuenciaAplicacionBarrenador=$request->frecuenciaAplicacionBarrenador;
        $plagas->tripsCultivo=$request->tripsCultivo;
        $plagas->tipoManejoTrips=$request->tipoManejoTrips;
        $plagas->frecuenciaAplicacionTrips=$request->frecuenciaAplicacionTrips;
        $plagas->afidiosCultivos=$request->afidiosCultivos;
        $plagas->tipoManejoAfidios=$request->tipoManejoAfidios;
        $plagas->frecuenciaAplicacionAfidios=$request->frecuenciaAplicacionAfidios;
        $plagas->afidiosCultivos=$request->afidiosCultivos;
        $plagas->acarosCultivos=$request->acarosCultivos;
        $plagas->tipoManejoAcaros=$request->tipoManejoAcaros;
        $plagas->frecuenciaAplicacionAcaros=$request->frecuenciaAplicacionAcaros;
        $plagas->cochinillaCultivos=$request->cochinillaCultivos;
        $plagas->tipoManejoCochinilla=$request->tipoManejoCochinilla;
        $plagas->frecuenciaAplicacionCochinilla=$request->frecuenciaAplicacionCochinilla;
        $plagas->save();
        DB::commit();
        }catch(Exception $e){
            DB::rollback();
        }
    }

    public function listarPdf(Request $request)
    {
        $ahora= Carbon::now('America/Bogota');
        $cont=Plaga::count();
        $plagas= Plaga::join('personas','plagas.productor_id','=','personas.id')
        ->join('productors','plagas.productor_id','=','productors.id')
        ->join('fincas','plagas.finca_id','=','fincas.id')
        ->select('personas.nombre','plagas.productor_id','plagas.finca_id','fincas.nombre as nombre_finca',
        'plagas.monitoreo','plagas.frecuenciaMonitoreo','plagas.perlaTierra','plagas.tipoManejoPerla','plagas.frecuenciaAplicacionPerla',
        'plagas.barrenadorCultivo','plagas.tipoManejoBarrenador','plagas.frecuenciaAplicacionPerla','plagas.barrenadorCultivo',
        'plagas.tipoManejoBarrenador','plagas.frecuenciaAplicacionBarrenador','plagas.tripsCultivo','plagas.tipoManejoTrips',
        'plagas.frecuenciaAplicacionTrips',
        'plagas.afidiosCultivos','plagas.tipoManejoAfidios','plagas.frecuenciaAplicacionAfidios','plagas.acarosCultivos',
        'plagas.tipoManejoAcaros','plagas.frecuenciaAplicacionAcaros','plagas.cochinillaCultivos','plagas.tipoManejoCochinilla',
        'plagas.frecuenciaAplicacionCochinilla')
        ->orderBy('plagas.id','desc')->get();
        $pdf = \PDF::loadView('pdf.plagas',['plagas'=>$plagas,'cont'=>$cont,'ahora'=>$ahora])->setPaper('a4', 'landscape');
        return $pdf->download('plagas.pdf');
    }

    public function excel(Request $request)
    {
        $plagas= Plaga::join('personas','plagas.productor_id','=','personas.id')
        ->join('productors','plagas.productor_id','=','productors.id')
        ->join('fincas','plagas.finca_id','=','fincas.id')
        ->select('personas.nombre','plagas.productor_id','plagas.finca_id','fincas.nombre as nombre_finca',
        'plagas.monitoreo','plagas.frecuenciaMonitoreo','plagas.perlaTierra','plagas.tipoManejoPerla','plagas.frecuenciaAplicacionPerla',
        'plagas.barrenadorCultivo','plagas.tipoManejoBarrenador','plagas.frecuenciaAplicacionPerla','plagas.barrenadorCultivo',
        'plagas.tipoManejoBarrenador','plagas.frecuenciaAplicacionBarrenador','plagas.tripsCultivo','plagas.tipoManejoTrips',
        'plagas.frecuenciaAplicacionTrips',
        'plagas.afidiosCultivos','plagas.tipoManejoAfidios','plagas.frecuenciaAplicacionAfidios','plagas.acarosCultivos',
        'plagas.tipoManejoAcaros','plagas.frecuenciaAplicacionAcaros','plagas.cochinillaCultivos','plagas.tipoManejoCochinilla',
        'plagas.frecuenciaAplicacionCochinilla')
        ->orderBy('plagas.id','desc')->get();
        return [
            'plagas' => $plagas
        ];
    }
        
}
