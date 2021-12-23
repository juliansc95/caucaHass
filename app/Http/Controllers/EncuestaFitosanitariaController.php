<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\EncuestaFitosanitaria;
use App\Persona;
class EncuestaFitosanitariaController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar == ''){
            $encuestas= EncuestaFitosanitaria::join('personas','encuesta_fitosanitarias.productor_id','=','personas.id')
            ->join('productors','encuesta_fitosanitarias.productor_id','=','productors.id')
            ->join('fincas','encuesta_fitosanitarias.finca_id','=','fincas.id')
            ->join('lineas','encuesta_fitosanitarias.linea_id','=','lineas.id')
            ->join('producto_fitosanitarios','encuesta_fitosanitarias.producto_fitosanitario_id','=','producto_fitosanitarios.id')
            ->join('unidad_dosis','encuesta_fitosanitarias.unidad_dosis_id','=','unidad_dosis.id')
            ->join('unidad_aplicaciones','encuesta_fitosanitarias.unidad_aplicaciones_id','=','unidad_aplicaciones.id')
            ->join('equipo_aplicaciones','encuesta_fitosanitarias.equipo_aplicaciones_id','=','equipo_aplicaciones.id')
            ->join('metodo_aplicaciones','encuesta_fitosanitarias.metodo_aplicaciones_id','=','metodo_aplicaciones.id')
            ->select('personas.nombre','encuesta_fitosanitarias.productor_id','encuesta_fitosanitarias.finca_id','fincas.nombre as nombre_finca',
            'encuesta_fitosanitarias.fechaControl','encuesta_fitosanitarias.productoSembrado','encuesta_fitosanitarias.lote',
            'encuesta_fitosanitarias.linea_id','lineas.nombre as nombre_linea','encuesta_fitosanitarias.numeroPlantas',
            'encuesta_fitosanitarias.producto_fitosanitario_id','producto_fitosanitarios.nombre as nombre_producto','encuesta_fitosanitarias.cantidad_dosis',
            'encuesta_fitosanitarias.unidad_dosis_id','unidad_dosis.nombre as unidad_dosis','encuesta_fitosanitarias.cantidad_aplicacion',
            'encuesta_fitosanitarias.unidad_aplicaciones_id','unidad_aplicaciones.nombre as unidad_aplicaciones',
            'encuesta_fitosanitarias.equipo_aplicaciones_id','equipo_aplicaciones.nombre as equipo_aplicaciones','encuesta_fitosanitarias.metodo_aplicaciones_id',
            'metodo_aplicaciones.nombre as metodo_aplicaciones')
            ->orderBy('encuesta_fitosanitarias.id','desc')->paginate(3);
        }
        if($criterio == 'personas'){
            $encuestas= EncuestaFitosanitaria::join('personas','encuesta_fitosanitarias.productor_id','=','personas.id')
            ->join('productors','encuesta_fitosanitarias.productor_id','=','productors.id')
            ->join('fincas','encuesta_fitosanitarias.finca_id','=','fincas.id')
            ->join('lineas','encuesta_fitosanitarias.linea_id','=','lineas.id')
            ->join('producto_fitosanitarios','encuesta_fitosanitarias.producto_fitosanitario_id','=','producto_fitosanitarios.id')
            ->join('unidad_dosis','encuesta_fitosanitarias.unidad_dosis_id','=','unidad_dosis.id')
            ->join('unidad_aplicaciones','encuesta_fitosanitarias.unidad_aplicaciones_id','=','unidad_aplicaciones.id')
            ->join('equipo_aplicaciones','encuesta_fitosanitarias.equipo_aplicaciones_id','=','equipo_aplicaciones.id')
            ->join('metodo_aplicaciones','encuesta_fitosanitarias.metodo_aplicaciones_id','=','metodo_aplicaciones.id')
            ->select('personas.nombre','encuesta_fitosanitarias.productor_id','encuesta_fitosanitarias.finca_id','fincas.nombre as nombre_finca',
            'encuesta_fitosanitarias.fechaControl','encuesta_fitosanitarias.productoSembrado','encuesta_fitosanitarias.lote',
            'encuesta_fitosanitarias.linea_id','lineas.nombre as nombre_linea','encuesta_fitosanitarias.numeroPlantas',
            'encuesta_fitosanitarias.producto_fitosanitario_id','producto_fitosanitarios.nombre as nombre_producto','encuesta_fitosanitarias.cantidad_dosis',
            'encuesta_fitosanitarias.unidad_dosis_id','unidad_dosis.nombre as unidad_dosis','encuesta_fitosanitarias.cantidad_aplicacion',
            'encuesta_fitosanitarias.unidad_aplicaciones_id','unidad_aplicaciones.nombre as unidad_aplicaciones',
            'encuesta_fitosanitarias.equipo_aplicaciones_id','equipo_aplicaciones.nombre as equipo_aplicaciones','encuesta_fitosanitarias.metodo_aplicaciones_id',
            'metodo_aplicaciones.nombre as metodo_aplicaciones')
            ->where($criterio.'.nombre', 'like', '%'. $buscar . '%')
            ->orderBy('encuesta_fitosanitarias.id', 'asc')->paginate(10);
            }
        else{
            $encuestas= EncuestaFitosanitaria::join('personas','encuesta_fitosanitarias.productor_id','=','personas.id')
            ->join('productors','encuesta_fitosanitarias.productor_id','=','productors.id')
            ->join('fincas','encuesta_fitosanitarias.finca_id','=','fincas.id')
            ->join('lineas','encuesta_fitosanitarias.linea_id','=','lineas.id')
            ->join('producto_fitosanitarios','encuesta_fitosanitarias.producto_fitosanitario_id','=','producto_fitosanitarios.id')
            ->join('unidad_dosis','encuesta_fitosanitarias.unidad_dosis_id','=','unidad_dosis.id')
            ->join('unidad_aplicaciones','encuesta_fitosanitarias.unidad_aplicaciones_id','=','unidad_aplicaciones.id')
            ->join('equipo_aplicaciones','encuesta_fitosanitarias.equipo_aplicaciones_id','=','equipo_aplicaciones.id')
            ->join('metodo_aplicaciones','encuesta_fitosanitarias.metodo_aplicaciones_id','=','metodo_aplicaciones.id')
            ->select('personas.nombre','encuesta_fitosanitarias.productor_id','encuesta_fitosanitarias.finca_id','fincas.nombre as nombre_finca',
            'encuesta_fitosanitarias.fechaControl','encuesta_fitosanitarias.productoSembrado','encuesta_fitosanitarias.lote',
            'encuesta_fitosanitarias.linea_id','lineas.nombre as nombre_linea','encuesta_fitosanitarias.numeroPlantas',
            'encuesta_fitosanitarias.producto_fitosanitario_id','producto_fitosanitarios.nombre as nombre_producto','encuesta_fitosanitarias.cantidad_dosis',
            'encuesta_fitosanitarias.unidad_dosis_id','unidad_dosis.nombre as unidad_dosis','encuesta_fitosanitarias.cantidad_aplicacion',
            'encuesta_fitosanitarias.unidad_aplicaciones_id','unidad_aplicaciones.nombre as unidad_aplicaciones',
            'encuesta_fitosanitarias.equipo_aplicaciones_id','equipo_aplicaciones.nombre as equipo_aplicaciones','encuesta_fitosanitarias.metodo_aplicaciones_id',
            'metodo_aplicaciones.nombre as metodo_aplicaciones')
            ->where('encuesta_fitosanitarias.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('encuesta_fitosanitarias.id', 'desc')->paginate(3);
        }
        return [
            'pagination' => [
                'total'        => $encuestas->total(),
                'current_page' => $encuestas->currentPage(),
                'per_page'     => $encuestas->perPage(),
                'last_page'    => $encuestas->lastPage(),
                'from'         => $encuestas->firstItem(),
                'to'           => $encuestas->lastItem(),
            ],
            'encuestas' => $encuestas
        ];
    }

    public function MostrarId(Request $request){

        $id = \Auth::user()->id;
        $user =(int)$id;
        $personas= Persona::select('id','nombre')
        ->where('id','=',$id)
        ->orderBy('id', 'desc')->take(1)->get();
        return['personas'=>$personas];
    }

    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        try{
        DB::beginTransaction();
        $encuesta = new EncuestaFitosanitaria();
        $encuesta->productor_id =  \Auth::user()->id;
        $encuesta->finca_id = $request->finca_id;
        $mytime= Carbon::parse($request->fechaControl)->toDateString();
        $encuesta->fechaControl =$mytime;
        $encuesta->productoSembrado = $request->productoSembrado;
        $encuesta->lote = $request->lote;
        $encuesta->linea_id = $request->linea_id;
        $encuesta->numeroPlantas = $request->numeroPlantas;
        $encuesta->producto_fitosanitario_id = $request->producto_fitosanitario_id;
        $encuesta->cantidad_dosis = $request->cantidad_dosis;
        $encuesta->unidad_dosis_id = $request->unidad_dosis_id;
        $encuesta->cantidad_aplicacion = $request->cantidad_aplicacion;
        $encuesta->unidad_aplicaciones_id = $request->unidad_aplicaciones_id;
        $encuesta->equipo_aplicaciones_id = $request->equipo_aplicaciones_id;
        $encuesta->metodo_aplicaciones_id = $request->metodo_aplicaciones_id;
        $encuesta->save();

            DB::commit();
        }catch(Exception $e){
            DB::rollback();
        }
    }

    public function storeApi(Request $request)
    {
        try{
            DB::beginTransaction();
            $encuesta = new EncuestaFitosanitaria();
            $encuesta->productor_id =  $request->productor_id;
            $encuesta->finca_id = $request->finca_id;
            $mytime= Carbon::parse($request->fechaControl)->toDateString();
            $encuesta->fechaControl =$mytime;
            $encuesta->productoSembrado = $request->productoSembrado;
            $encuesta->lote = $request->lote;
            $encuesta->linea_id = $request->linea_id;
            $encuesta->numeroPlantas = $request->numeroPlantas;
            $encuesta->producto_fitosanitario_id = $request->producto_fitosanitario_id;
            $encuesta->cantidad_dosis = $request->cantidad_dosis;
            $encuesta->unidad_dosis_id = $request->unidad_dosis_id;
            $encuesta->cantidad_aplicacion = $request->cantidad_aplicacion;
            $encuesta->unidad_aplicaciones_id = $request->unidad_aplicaciones_id;
            $encuesta->equipo_aplicaciones_id = $request->equipo_aplicaciones_id;
            $encuesta->metodo_aplicaciones_id = $request->metodo_aplicaciones_id;
            $encuesta->save();

            DB::commit();
        }catch(Exception $e){
            DB::rollback();
        }
    }

    public function listarPdf(Request $request)
    {
        $ahora= Carbon::now('America/Bogota');    
        $encuestas= EncuestaFitosanitaria::join('personas','encuesta_fitosanitarias.productor_id','=','personas.id')
            ->join('productors','encuesta_fitosanitarias.productor_id','=','productors.id')
            ->join('fincas','encuesta_fitosanitarias.finca_id','=','fincas.id')
            ->join('lineas','encuesta_fitosanitarias.linea_id','=','lineas.id')
            ->join('producto_fitosanitarios','encuesta_fitosanitarias.producto_fitosanitario_id','=','producto_fitosanitarios.id')
            ->join('unidad_dosis','encuesta_fitosanitarias.unidad_dosis_id','=','unidad_dosis.id')
            ->join('unidad_aplicaciones','encuesta_fitosanitarias.unidad_aplicaciones_id','=','unidad_aplicaciones.id')
            ->join('equipo_aplicaciones','encuesta_fitosanitarias.equipo_aplicaciones_id','=','equipo_aplicaciones.id')
            ->join('metodo_aplicaciones','encuesta_fitosanitarias.metodo_aplicaciones_id','=','metodo_aplicaciones.id')
            ->select('personas.nombre','encuesta_fitosanitarias.productor_id','encuesta_fitosanitarias.finca_id','fincas.nombre as nombre_finca',
            'encuesta_fitosanitarias.fechaControl','encuesta_fitosanitarias.productoSembrado','encuesta_fitosanitarias.lote',
            'encuesta_fitosanitarias.linea_id','lineas.nombre as nombre_linea','encuesta_fitosanitarias.numeroPlantas',
            'encuesta_fitosanitarias.producto_fitosanitario_id','producto_fitosanitarios.nombre as nombre_producto','encuesta_fitosanitarias.cantidad_dosis',
            'encuesta_fitosanitarias.unidad_dosis_id','unidad_dosis.nombre as unidad_dosis','encuesta_fitosanitarias.cantidad_aplicacion',
            'encuesta_fitosanitarias.unidad_aplicaciones_id','unidad_aplicaciones.nombre as unidad_aplicaciones',
            'encuesta_fitosanitarias.equipo_aplicaciones_id','equipo_aplicaciones.nombre as equipo_aplicaciones','encuesta_fitosanitarias.metodo_aplicaciones_id',
            'metodo_aplicaciones.nombre as metodo_aplicaciones')
            ->orderBy('encuesta_fitosanitarias.id','desc')->get();
            $cont=EncuestaFitosanitaria::count();

            $pdf = \PDF::loadView('pdf.fitosanitaria',['encuestas'=>$encuestas,'cont'=>$cont,'ahora'=>$ahora])->setPaper('a4', 'landscape');
            return $pdf->download('fitosanitaria.pdf');
        
    }

    public function excel(Request $request)
    {  
        $encuestas= EncuestaFitosanitaria::join('personas','encuesta_fitosanitarias.productor_id','=','personas.id')
            ->join('productors','encuesta_fitosanitarias.productor_id','=','productors.id')
            ->join('fincas','encuesta_fitosanitarias.finca_id','=','fincas.id')
            ->join('lineas','encuesta_fitosanitarias.linea_id','=','lineas.id')
            ->join('producto_fitosanitarios','encuesta_fitosanitarias.producto_fitosanitario_id','=','producto_fitosanitarios.id')
            ->join('unidad_dosis','encuesta_fitosanitarias.unidad_dosis_id','=','unidad_dosis.id')
            ->join('unidad_aplicaciones','encuesta_fitosanitarias.unidad_aplicaciones_id','=','unidad_aplicaciones.id')
            ->join('equipo_aplicaciones','encuesta_fitosanitarias.equipo_aplicaciones_id','=','equipo_aplicaciones.id')
            ->join('metodo_aplicaciones','encuesta_fitosanitarias.metodo_aplicaciones_id','=','metodo_aplicaciones.id')
            ->select('personas.nombre','encuesta_fitosanitarias.productor_id','encuesta_fitosanitarias.finca_id','fincas.nombre as nombre_finca',
            'encuesta_fitosanitarias.fechaControl','encuesta_fitosanitarias.productoSembrado','encuesta_fitosanitarias.lote',
            'encuesta_fitosanitarias.linea_id','lineas.nombre as nombre_linea','encuesta_fitosanitarias.numeroPlantas',
            'encuesta_fitosanitarias.producto_fitosanitario_id','producto_fitosanitarios.nombre as nombre_producto','encuesta_fitosanitarias.cantidad_dosis',
            'encuesta_fitosanitarias.unidad_dosis_id','unidad_dosis.nombre as unidad_dosis','encuesta_fitosanitarias.cantidad_aplicacion',
            'encuesta_fitosanitarias.unidad_aplicaciones_id','unidad_aplicaciones.nombre as unidad_aplicaciones',
            'encuesta_fitosanitarias.equipo_aplicaciones_id','equipo_aplicaciones.nombre as equipo_aplicaciones','encuesta_fitosanitarias.metodo_aplicaciones_id',
            'metodo_aplicaciones.nombre as metodo_aplicaciones')
            ->orderBy('encuesta_fitosanitarias.id','desc')->get();
            return [
                'encuestas' => $encuestas
            ];
           
        
    }
}
