<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Practica;
use Carbon\Carbon;


class PracticaController extends Controller
{
    public function index(Request $request)
    {
    if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar == ''){
            $practicas= Practica::join('personas','practicas.productor_id','=','personas.id')
            ->join('productors','practicas.productor_id','=','productors.id')
            ->join('fincas','practicas.finca_id','=','fincas.id')
            ->select('personas.nombre','practicas.productor_id','practicas.finca_id','fincas.nombre as nombre_finca',
            'practicas.vivenda','practicas.viveSitio','practicas.bateriaSanitaria','practicas.pozoSeptico','practicas.zonaBarbecho',
            'practicas.usaBarbecho','practicas.agroquimicos','practicas.mezclaAgroquimicos','practicas.usaAgroquimicos',
            'practicas.bodegaMateriales','practicas.usaBodega','practicas.canastillas','practicas.usaCanastillas','practicas.trajeProteccion',
            'practicas.usaTraje','practicas.puntoEcologico','practicas.usaPuntoEcologico','practicas.botiquin','practicas.usaBotiquin',
            'practicas.extintor','practicas.usaExtintor','practicas.capacitacionesBPA','practicas.certificadas','practicas.institucionCertificado',
            'practicas.tiempo')
            ->orderBy('practicas.id','desc')->paginate(3);
        }
        if($criterio == 'personas'){
            $practicas= Practica::join('personas','practicas.productor_id','=','personas.id')
            ->join('productors','practicas.productor_id','=','productors.id')
            ->join('fincas','practicas.finca_id','=','fincas.id')
            ->select('personas.nombre','practicas.productor_id','practicas.finca_id','fincas.nombre as nombre_finca',
            'practicas.vivenda','practicas.viveSitio','practicas.bateriaSanitaria','practicas.pozoSeptico','practicas.zonaBarbecho',
            'practicas.usaBarbecho','practicas.agroquimicos','practicas.mezclaAgroquimicos','practicas.usaAgroquimicos',
            'practicas.bodegaMateriales','practicas.usaBodega','practicas.canastillas','practicas.usaCanastillas','practicas.trajeProteccion',
            'practicas.usaTraje','practicas.puntoEcologico','practicas.usaPuntoEcologico','practicas.botiquin','practicas.usaBotiquin',
            'practicas.extintor','practicas.usaExtintor','practicas.capacitacionesBPA','practicas.certificadas','practicas.institucionCertificado',
            'practicas.tiempo')
            ->where($criterio.'.nombre', 'like', '%'. $buscar . '%')
            ->orderBy('practicas.id', 'asc')->paginate(3);
            }
        else{
            $practicas= Practica::join('personas','practicas.productor_id','=','personas.id')
            ->join('productors','practicas.productor_id','=','productors.id')
            ->join('fincas','practicas.finca_id','=','fincas.id')
            ->select('personas.nombre','practicas.productor_id','practicas.finca_id','fincas.nombre as nombre_finca',
            'practicas.vivenda','practicas.viveSitio','practicas.bateriaSanitaria','practicas.pozoSeptico','practicas.zonaBarbecho',
            'practicas.usaBarbecho','practicas.agroquimicos','practicas.mezclaAgroquimicos','practicas.usaAgroquimicos',
            'practicas.bodegaMateriales','practicas.usaBodega','practicas.canastillas','practicas.usaCanastillas','practicas.trajeProteccion',
            'practicas.usaTraje','practicas.puntoEcologico','practicas.usaPuntoEcologico','practicas.botiquin','practicas.usaBotiquin',
            'practicas.extintor','practicas.usaExtintor','practicas.capacitacionesBPA','practicas.certificadas','practicas.institucionCertificado',
            'practicas.tiempo')
            ->where('practicas.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('practicas.id', 'desc')->paginate(3);
        }
        return [
            'pagination' => [
                'total'        => $practicas->total(),
                'current_page' => $practicas->currentPage(),
                'per_page'     => $practicas->perPage(),
                'last_page'    => $practicas->lastPage(),
                'from'         => $practicas->firstItem(),
                'to'           => $practicas->lastItem(),
            ],
            'practicas' => $practicas
        ];
    }
    public function store(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');
        try{
        DB::beginTransaction();
        $practica = new Practica();
        $practica->productor_id = $request->productor_id;
        $practica->finca_id = $request->finca_id;
        $practica->vivenda=$request->vivenda;
        $practica->viveSitio=$request->viveSitio;
        $practica->bateriaSanitaria= $request->bateriaSanitaria;
        $practica->pozoSeptico= $request->pozoSeptico;
        $practica->zonaBarbecho= $request->zonaBarbecho;
        $practica->usaBarbecho= $request->usaBarbecho;
        $practica->agroquimicos= $request->agroquimicos;
        $practica->mezclaAgroquimicos= $request->mezclaAgroquimicos;
        $practica->usaAgroquimicos= $request->usaAgroquimicos;
        $practica->bodegaMateriales= $request->bodegaMateriales;
        $practica->usaBodega= $request->usaBodega;
        $practica->canastillas= $request->canastillas;
        $practica->usaCanastillas= $request->usaCanastillas;
        $practica->trajeProteccion= $request->trajeProteccion;
        $practica->usaTraje= $request->usaTraje;
        $practica->puntoEcologico= $request->puntoEcologico;
        $practica->usaPuntoEcologico= $request->usaPuntoEcologico;
        $practica->botiquin= $request->botiquin;
        $practica->usaBotiquin= $request->usaBotiquin;
        $practica->extintor= $request->extintor;
        $practica->usaExtintor= $request->usaExtintor;
        $practica->capacitacionesBPA= $request->capacitacionesBPA;
        $practica->certificadas= $request->certificadas;
        $practica->institucionCertificado= $request->institucionCertificado;
        $practica->tiempo = $request->tiempo;
        $practica->save();
        DB::commit();
        }catch(Exception $e){
            DB::rollback();
        }
    }

    public function listarPdf(Request $request)
    {   
        $ahora= Carbon::now('America/Bogota');
        $cont=Practica::count();    
        $practicas= Practica::join('personas','practicas.productor_id','=','personas.id')
        ->join('productors','practicas.productor_id','=','productors.id')
        ->join('fincas','practicas.finca_id','=','fincas.id')
        ->select('personas.nombre','practicas.productor_id','practicas.finca_id','fincas.nombre as nombre_finca',
        'practicas.vivenda','practicas.viveSitio','practicas.bateriaSanitaria','practicas.pozoSeptico','practicas.zonaBarbecho',
        'practicas.usaBarbecho','practicas.agroquimicos','practicas.mezclaAgroquimicos','practicas.usaAgroquimicos',
        'practicas.bodegaMateriales','practicas.usaBodega','practicas.canastillas','practicas.usaCanastillas','practicas.trajeProteccion',
        'practicas.usaTraje','practicas.puntoEcologico','practicas.usaPuntoEcologico','practicas.botiquin','practicas.usaBotiquin',
        'practicas.extintor','practicas.usaExtintor','practicas.capacitacionesBPA','practicas.certificadas','practicas.institucionCertificado',
        'practicas.tiempo')
        ->orderBy('practicas.id','desc')->get();
        $pdf = \PDF::loadView('pdf.practicas',['practicas'=>$practicas,'cont'=>$cont,'ahora'=>$ahora])->setPaper('a4', 'landscape');
        return $pdf->download('practicas.pdf');   
    }

    public function excel(Request $request)
    {   
        $practicas= Practica::join('personas','practicas.productor_id','=','personas.id')
        ->join('productors','practicas.productor_id','=','productors.id')
        ->join('fincas','practicas.finca_id','=','fincas.id')
        ->select('personas.nombre','practicas.productor_id','practicas.finca_id','fincas.nombre as nombre_finca',
        'practicas.vivenda','practicas.viveSitio','practicas.bateriaSanitaria','practicas.pozoSeptico','practicas.zonaBarbecho',
        'practicas.usaBarbecho','practicas.agroquimicos','practicas.mezclaAgroquimicos','practicas.usaAgroquimicos',
        'practicas.bodegaMateriales','practicas.usaBodega','practicas.canastillas','practicas.usaCanastillas','practicas.trajeProteccion',
        'practicas.usaTraje','practicas.puntoEcologico','practicas.usaPuntoEcologico','practicas.botiquin','practicas.usaBotiquin',
        'practicas.extintor','practicas.usaExtintor','practicas.capacitacionesBPA','practicas.certificadas','practicas.institucionCertificado',
        'practicas.tiempo')
        ->orderBy('practicas.id','desc')->get();
        return [
            'practicas' => $practicas
        ];
        
    }
           
}
