<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\EncuestaAsofrut;
use App\Persona;
use Carbon\Carbon;


class EncuestaAsofrutController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar == ''){
            $encuestas= EncuestaAsofrut::join('personas','encuestaAsofruts.productor_id','=','personas.id')
            ->join('productors','encuestaAsofruts.productor_id','=','productors.id')
            ->join('fincas','encuestaAsofruts.finca_id','=','fincas.id')
            ->select('personas.nombre','encuestaAsofruts.productor_id','encuestaAsofruts.finca_id','fincas.nombre as nombre_finca',
            'encuestaAsofruts.certificacion1','encuestaAsofruts.certificacion2','encuestaAsofruts.ecosistemas1','encuestaAsofruts.ecosistemas2',
            'encuestaAsofruts.ecosistemas3','encuestaAsofruts.ecosistemas4','encuestaAsofruts.ecosistemas5','encuestaAsofruts.ecosistemas6',
            'encuestaAsofruts.ecosistemas7','encuestaAsofruts.ecosistemas8','encuestaAsofruts.silvestre1',
            'encuestaAsofruts.silvestre2','encuestaAsofruts.silvestre3','encuestaAsofruts.silvestre4','encuestaAsofruts.silvestre5',
            'encuestaAsofruts.silvestre6','encuestaAsofruts.silvestre7','encuestaAsofruts.silvestre8',
            'encuestaAsofruts.silvestre9','encuestaAsofruts.silvestre10','encuestaAsofruts.silvestre11','encuestaAsofruts.silvestre12',
            'encuestaAsofruts.silvestre13','encuestaAsofruts.silvestre14','encuestaAsofruts.silvestre15','encuestaAsofruts.silvestre16',
            'encuestaAsofruts.silvestre17','encuestaAsofruts.silvestre18','encuestaAsofruts.silvestre19','encuestaAsofruts.silvestre20',
            'encuestaAsofruts.conservacion1','encuestaAsofruts.conservacion2','encuestaAsofruts.conservacion3','encuestaAsofruts.conservacion4',
            'encuestaAsofruts.conservacion5','encuestaAsofruts.conservacion6','encuestaAsofruts.desechos1','encuestaAsofruts.desechos2',
            'encuestaAsofruts.desechos3','encuestaAsofruts.desechos4','encuestaAsofruts.cultivo','encuestaAsofruts.created_at')
            ->orderBy('encuestaAsofruts.id','desc')->paginate(3);
        }
        if($criterio == 'personas'){
            $encuestas= EncuestaAsofrut::join('personas','encuestaAsofruts.productor_id','=','personas.id')
            ->join('productors','encuestaAsofruts.productor_id','=','productors.id')
            ->join('fincas','encuestaAsofruts.finca_id','=','fincas.id')
            ->select('personas.nombre','encuestaAsofruts.productor_id','encuestaAsofruts.finca_id','fincas.nombre as nombre_finca',
            'encuestaAsofruts.certificacion1','encuestaAsofruts.certificacion2','encuestaAsofruts.ecosistemas1','encuestaAsofruts.ecosistemas2',
            'encuestaAsofruts.ecosistemas3','encuestaAsofruts.ecosistemas4','encuestaAsofruts.ecosistemas5','encuestaAsofruts.ecosistemas6',
            'encuestaAsofruts.ecosistemas7','encuestaAsofruts.ecosistemas8','encuestaAsofruts.silvestre1',
            'encuestaAsofruts.silvestre2','encuestaAsofruts.silvestre3','encuestaAsofruts.silvestre4','encuestaAsofruts.silvestre5',
            'encuestaAsofruts.silvestre6','encuestaAsofruts.silvestre7','encuestaAsofruts.silvestre8',
            'encuestaAsofruts.silvestre9','encuestaAsofruts.silvestre10','encuestaAsofruts.silvestre11','encuestaAsofruts.silvestre12',
            'encuestaAsofruts.silvestre13','encuestaAsofruts.silvestre14','encuestaAsofruts.silvestre15','encuestaAsofruts.silvestre16',
            'encuestaAsofruts.silvestre17','encuestaAsofruts.silvestre18','encuestaAsofruts.silvestre19','encuestaAsofruts.silvestre20',
            'encuestaAsofruts.conservacion1','encuestaAsofruts.conservacion2','encuestaAsofruts.conservacion3','encuestaAsofruts.conservacion4',
            'encuestaAsofruts.conservacion5','encuestaAsofruts.conservacion6','encuestaAsofruts.desechos1','encuestaAsofruts.desechos2',
            'encuestaAsofruts.desechos3','encuestaAsofruts.desechos4','encuestaAsofruts.cultivo','encuestaAsofruts.created_at')
            ->where($criterio.'.nombre', 'like', '%'. $buscar . '%')
            ->orderBy('encuestaAsofruts.id', 'asc')->paginate(3);
            }
        else{
            $encuestas= EncuestaAsofrut::join('personas','encuestaAsofruts.productor_id','=','personas.id')
            ->join('productors','encuestaAsofruts.productor_id','=','productors.id')
            ->join('fincas','encuestaAsofruts.finca_id','=','fincas.id')
            ->select('personas.nombre','encuestaAsofruts.productor_id','encuestaAsofruts.finca_id','fincas.nombre as nombre_finca',
            'encuestaAsofruts.certificacion1','encuestaAsofruts.certificacion2','encuestaAsofruts.ecosistemas1','encuestaAsofruts.ecosistemas2',
            'encuestaAsofruts.ecosistemas3','encuestaAsofruts.ecosistemas4','encuestaAsofruts.ecosistemas5','encuestaAsofruts.ecosistemas6',
            'encuestaAsofruts.ecosistemas7','encuestaAsofruts.ecosistemas8','encuestaAsofruts.silvestre1',
            'encuestaAsofruts.silvestre2','encuestaAsofruts.silvestre3','encuestaAsofruts.silvestre4','encuestaAsofruts.silvestre5',
            'encuestaAsofruts.silvestre6','encuestaAsofruts.silvestre7','encuestaAsofruts.silvestre8',
            'encuestaAsofruts.silvestre9','encuestaAsofruts.silvestre10','encuestaAsofruts.silvestre11','encuestaAsofruts.silvestre12',
            'encuestaAsofruts.silvestre13','encuestaAsofruts.silvestre14','encuestaAsofruts.silvestre15','encuestaAsofruts.silvestre16',
            'encuestaAsofruts.silvestre17','encuestaAsofruts.silvestre18','encuestaAsofruts.silvestre19','encuestaAsofruts.silvestre20',
            'encuestaAsofruts.conservacion1','encuestaAsofruts.conservacion2','encuestaAsofruts.conservacion3','encuestaAsofruts.conservacion4',
            'encuestaAsofruts.conservacion5','encuestaAsofruts.conservacion6','encuestaAsofruts.desechos1','encuestaAsofruts.desechos2',
            'encuestaAsofruts.desechos3','encuestaAsofruts.desechos4','encuestaAsofruts.cultivo','encuestaAsofruts.created_at')
            ->where('encuestaAsofruts.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('encuestaAsofruts.id', 'desc')->paginate(3);          
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
    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        try{
        DB::beginTransaction();
        $encuesta = new EncuestaAsofrut();
        $encuesta->productor_id = $request->productor_id;
        $encuesta->finca_id = $request->finca_id;
        $encuesta->certificacion1 = $request->certificacion1;
        $encuesta->certificacion2 = $request->certificacion2;
        $encuesta->ecosistemas1 = $request->ecosistemas1;
        $encuesta->ecosistemas2 = $request->ecosistemas2;
        $encuesta->ecosistemas3 = $request->ecosistemas3;
        $encuesta->ecosistemas4 = $request->ecosistemas4;
        $encuesta->ecosistemas5 = $request->ecosistemas5;
        $encuesta->ecosistemas6 = $request->ecosistemas6;
        $encuesta->ecosistemas7 = $request->ecosistemas7;
        $encuesta->ecosistemas8 = $request->ecosistemas8;
        $encuesta->silvestre1 = $request->silvestre1;
        $encuesta->silvestre2 = $request->silvestre2;
        $encuesta->silvestre3 = $request->silvestre3;
        $encuesta->silvestre4 = $request->silvestre4;
        $encuesta->silvestre5 = $request->silvestre5;
        $encuesta->silvestre6 = $request->silvestre6;
        $encuesta->silvestre7 = $request->silvestre7;
        $encuesta->silvestre8 = $request->silvestre8;
        $encuesta->silvestre9 = $request->silvestre9;
        $encuesta->silvestre10 = $request->silvestre10;
        $encuesta->silvestre11 = $request->silvestre11;
        $encuesta->silvestre12 = $request->silvestre12;
        $encuesta->silvestre13 = $request->silvestre13;
        $encuesta->silvestre14 = $request->silvestre14;
        $encuesta->silvestre15 = $request->silvestre15;
        $encuesta->silvestre16 = $request->silvestre16;
        $encuesta->silvestre17 = $request->silvestre17;
        $encuesta->silvestre18 = $request->silvestre18;
        $encuesta->silvestre19 = $request->silvestre19;
        $encuesta->silvestre20 = $request->silvestre20;
        $encuesta->conservacion1 = $request->conservacion1;
        $encuesta->conservacion2 = $request->conservacion2;
        $encuesta->conservacion3 = $request->conservacion3;
        $encuesta->conservacion4 = $request->conservacion4;
        $encuesta->conservacion5 = $request->conservacion5;
        $encuesta->conservacion6 = $request->conservacion6;
        $encuesta->desechos1 = $request->desechos1;    
        $encuesta->desechos2 = $request->desechos2;
        $encuesta->desechos3 = $request->desechos3;
        $encuesta->desechos4 = $request->desechos4;
        $encuesta->cultivo = $request->cultivo;    
        $encuesta->save();
            DB::commit();
        }catch(Exception $e){
            DB::rollback();
        }
    }

    public function listarPdf(Request $request)
    {
        $ahora= Carbon::now('America/Bogota');
        $cont=EncuestaAsofrut::count();
        $encuestas= EncuestaAsofrut::join('personas','encuestaAsofruts.productor_id','=','personas.id')
        ->join('productors','encuestaAsofruts.productor_id','=','productors.id')
        ->join('fincas','encuestaAsofruts.finca_id','=','fincas.id')
        ->select('personas.nombre','encuestaAsofruts.productor_id','encuestaAsofruts.finca_id','fincas.nombre as nombre_finca',
        'encuestaAsofruts.certificacion1','encuestaAsofruts.certificacion2','encuestaAsofruts.ecosistemas1','encuestaAsofruts.ecosistemas2',
        'encuestaAsofruts.ecosistemas3','encuestaAsofruts.ecosistemas4','encuestaAsofruts.ecosistemas5','encuestaAsofruts.ecosistemas6',
        'encuestaAsofruts.ecosistemas7','encuestaAsofruts.ecosistemas8','encuestaAsofruts.silvestre1',
        'encuestaAsofruts.silvestre2','encuestaAsofruts.silvestre3','encuestaAsofruts.silvestre4','encuestaAsofruts.silvestre5',
        'encuestaAsofruts.silvestre6','encuestaAsofruts.silvestre7','encuestaAsofruts.silvestre8',
        'encuestaAsofruts.silvestre9','encuestaAsofruts.silvestre10','encuestaAsofruts.silvestre11','encuestaAsofruts.silvestre12',
        'encuestaAsofruts.silvestre13','encuestaAsofruts.silvestre14','encuestaAsofruts.silvestre15','encuestaAsofruts.silvestre16',
        'encuestaAsofruts.silvestre17','encuestaAsofruts.silvestre18','encuestaAsofruts.silvestre19','encuestaAsofruts.silvestre20',
        'encuestaAsofruts.conservacion1','encuestaAsofruts.conservacion2','encuestaAsofruts.conservacion3','encuestaAsofruts.conservacion4',
        'encuestaAsofruts.conservacion5','encuestaAsofruts.conservacion6','encuestaAsofruts.desechos1','encuestaAsofruts.desechos2',
        'encuestaAsofruts.desechos3','encuestaAsofruts.desechos4','encuestaAsofruts.cultivo','encuestaAsofruts.created_at')
        ->orderBy('encuestaAsofruts.id','desc')->get();
        $pdf = \PDF::loadView('pdf.encuesta',['encuestas'=>$encuestas,'cont'=>$cont,'ahora'=>$ahora])->setPaper('a4', 'landscape');
        return $pdf->download('encuesta.pdf');   
    }

    public function excel(Request $request)
    {
        $encuestas= EncuestaAsofrut::join('personas','encuestaAsofruts.productor_id','=','personas.id')
        ->join('productors','encuestaAsofruts.productor_id','=','productors.id')
        ->join('fincas','encuestaAsofruts.finca_id','=','fincas.id')
        ->select('personas.nombre','encuestaAsofruts.productor_id','encuestaAsofruts.finca_id','fincas.nombre as nombre_finca',
        'encuestaAsofruts.certificacion1','encuestaAsofruts.certificacion2','encuestaAsofruts.ecosistemas1','encuestaAsofruts.ecosistemas2',
        'encuestaAsofruts.ecosistemas3','encuestaAsofruts.ecosistemas4','encuestaAsofruts.ecosistemas5','encuestaAsofruts.ecosistemas6',
        'encuestaAsofruts.ecosistemas7','encuestaAsofruts.ecosistemas8','encuestaAsofruts.silvestre1',
        'encuestaAsofruts.silvestre2','encuestaAsofruts.silvestre3','encuestaAsofruts.silvestre4','encuestaAsofruts.silvestre5',
        'encuestaAsofruts.silvestre6','encuestaAsofruts.silvestre7','encuestaAsofruts.silvestre8',
        'encuestaAsofruts.silvestre9','encuestaAsofruts.silvestre10','encuestaAsofruts.silvestre11','encuestaAsofruts.silvestre12',
        'encuestaAsofruts.silvestre13','encuestaAsofruts.silvestre14','encuestaAsofruts.silvestre15','encuestaAsofruts.silvestre16',
        'encuestaAsofruts.silvestre17','encuestaAsofruts.silvestre18','encuestaAsofruts.silvestre19','encuestaAsofruts.silvestre20',
        'encuestaAsofruts.conservacion1','encuestaAsofruts.conservacion2','encuestaAsofruts.conservacion3','encuestaAsofruts.conservacion4',
        'encuestaAsofruts.conservacion5','encuestaAsofruts.conservacion6','encuestaAsofruts.desechos1','encuestaAsofruts.desechos2',
        'encuestaAsofruts.desechos3','encuestaAsofruts.desechos4','encuestaAsofruts.cultivo','encuestaAsofruts.created_at')
        ->orderBy('encuestaAsofruts.id','desc')->get();
        return ['encuestas'=>$encuestas];
        
    }
}
