<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Productor;
use App\Persona;
use App\User;

class ProductorController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar == ''){
            $personas= Productor::join('personas','productors.id','=','personas.id')
            ->join('sexos','productors.sexo_id','=','sexos.id')
            ->join('departamentos','productors.departamento_id','=','departamentos.id')
            ->join('municipios','productors.municipio_id','=','municipios.id')
            ->select('personas.id','personas.nombre','personas.tipo_id','personas.num_documento','personas.direccion','personas.telefono','personas.email',
            'productors.fechaExpedicion','productors.fechaNacimiento','productors.sexo_id','sexos.nombre as nombre_sexo',
            'productors.departamento_id','departamentos.nombre as nombre_departamento','productors.municipio_id','municipios.nombre as nombre_municipio',
            'productors.vereda','productors.fechaIngreso')
            ->orderBy('productors.id','desc')->paginate(10);
        }
        if($criterio == 'veredas' ||$criterio == 'resguardos'){
            $personas= Productor::join('personas','productors.id','=','personas.id')
            ->join('sexos','productors.sexo_id','=','sexos.id')
            ->join('departamentos','productors.departamento_id','=','departamentos.id')
            ->join('municipios','productors.municipio_id','=','municipios.id')
            ->select('personas.id','personas.nombre','personas.tipo_id','personas.num_documento','personas.direccion','personas.telefono','personas.email',
            'productors.fechaExpedicion','productors.fechaNacimiento','productors.sexo_id','sexos.nombre as nombre_sexo',
            'productors.departamento_id','departamentos.nombre as nombre_departamento','productors.municipio_id','municipios.nombre as nombre_municipio',
            'productors.vereda','productors.fechaIngreso')
            ->where($criterio.'.nombre', 'like', '%'. $buscar . '%')
            ->orderBy('personas.id', 'desc')->paginate(10);
        }
        else{
            $personas= Productor::join('personas','productors.id','=','personas.id')
            ->join('sexos','productors.sexo_id','=','sexos.id')
            ->join('departamentos','productors.departamento_id','=','departamentos.id')
            ->join('municipios','productors.municipio_id','=','municipios.id')
            ->select('personas.id','personas.nombre','personas.tipo_id','personas.num_documento','personas.direccion','personas.telefono','personas.email',
            'productors.fechaExpedicion','productors.fechaNacimiento','productors.sexo_id','sexos.nombre as nombre_sexo',
            'productors.departamento_id','departamentos.nombre as nombre_departamento','productors.municipio_id','municipios.nombre as nombre_municipio',
            'productors.vereda','productors.fechaIngreso')
            ->where('personas.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('personas.id', 'desc')->paginate(10);
        }
        return [
            'pagination' => [
                'total'        => $personas->total(),
                'current_page' => $personas->currentPage(),
                'per_page'     => $personas->perPage(),
                'last_page'    => $personas->lastPage(),
                'from'         => $personas->firstItem(),
                'to'           => $personas->lastItem(),
            ],
            'personas' => $personas
        ];
    }

    public function indexProductor(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        $id = \Auth::user()->id;

        if($buscar == ''){
            $personas= Productor::join('personas','productors.id','=','personas.id')
            ->join('sexos','productors.sexo_id','=','sexos.id')
            ->join('departamentos','productors.departamento_id','=','departamentos.id')
            ->join('municipios','productors.municipio_id','=','municipios.id')
            ->select('personas.id','personas.nombre','personas.tipo_id','personas.num_documento','personas.direccion','personas.telefono','personas.email',
            'productors.fechaExpedicion','productors.fechaNacimiento','productors.sexo_id','sexos.nombre as nombre_sexo',
            'productors.departamento_id','departamentos.nombre as nombre_departamento','productors.municipio_id','municipios.nombre as nombre_municipio',
            'productors.vereda_id','veredas.nombre as nombre_vereda','productors.resguardo_id','resguardos.nombre as nombre_resguardo','productors.fechaIngreso',
            'productors.fotocopiaCedula')
            ->where('productors.id','=',$id)
            ->orderBy('productors.id','desc')->paginate(3);
        }
        if($criterio == 'veredas' ||$criterio == 'resguardos'){
            $personas= Productor::join('personas','productors.id','=','personas.id')
            ->join('sexos','productors.sexo_id','=','sexos.id')
            ->join('departamentos','productors.departamento_id','=','departamentos.id')
            ->join('municipios','productors.municipio_id','=','municipios.id')
            ->select('personas.id','personas.nombre','personas.tipo_id','personas.num_documento','personas.direccion','personas.telefono','personas.email',
            'productors.fechaExpedicion','productors.fechaNacimiento','productors.sexo_id','sexos.nombre as nombre_sexo',
            'productors.etnia_id','etnias.nombre as nombre_etnia','productors.escolaridad_id','gradoEscolaridads.nombre as nombre_escolaridad',
            'productors.departamento_id','departamentos.nombre as nombre_departamento','productors.municipio_id','municipios.nombre as nombre_municipio',
            'productors.vereda_id','veredas.nombre as nombre_vereda','productors.resguardo_id','resguardos.nombre as nombre_resguardo','productors.fechaIngreso',
            'productors.fotocopiaCedula')
            ->where('productors.id','=',$id)
            ->where($criterio.'.nombre', 'like', '%'. $buscar . '%')
            ->orderBy('personas.id', 'desc')->paginate(3);
        }
        else{
            $personas= Productor::join('personas','productors.id','=','personas.id')
            ->join('sexos','productors.sexo_id','=','sexos.id')
            ->join('departamentos','productors.departamento_id','=','departamentos.id')
            ->join('municipios','productors.municipio_id','=','municipios.id')
            ->select('personas.id','personas.nombre','personas.tipo_id','personas.num_documento','personas.direccion','personas.telefono','personas.email',
            'productors.fechaExpedicion','productors.fechaNacimiento','productors.sexo_id','sexos.nombre as nombre_sexo',
            'productors.etnia_id','etnias.nombre as nombre_etnia','productors.escolaridad_id','gradoEscolaridads.nombre as nombre_escolaridad',
            'productors.departamento_id','departamentos.nombre as nombre_departamento','productors.municipio_id','municipios.nombre as nombre_municipio',
            'productors.vereda_id','veredas.nombre as nombre_vereda','productors.resguardo_id','resguardos.nombre as nombre_resguardo','productors.fechaIngreso',
            'productors.fotocopiaCedula')
            ->where('productors.id','=',$id)
            ->where('personas.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('personas.id', 'desc')->paginate(3);
        }
        return [
            'pagination' => [
                'total'        => $personas->total(),
                'current_page' => $personas->currentPage(),
                'per_page'     => $personas->perPage(),
                'last_page'    => $personas->lastPage(),
                'from'         => $personas->firstItem(),
                'to'           => $personas->lastItem(),
            ],
            'personas' => $personas
        ];
    }

    public function store(Request $request)
    {
        //if(!$request->ajax()) return redirect('/');
        try{
        DB::beginTransaction();
        $persona = new Persona();
            $persona->nombre = $request->nombre;
            $persona->tipo_id = $request->tipo_id;
            $persona->num_documento = $request->num_documento;
            $persona->direccion = $request->direccion;
            $persona->telefono = $request->telefono;
            $persona->email = $request->email;
            $persona->save();

            $mytime= Carbon::parse($request->fechaExpedicion)->toDateString();
            $nacimiento= Carbon::parse($request->fechaNacimiento)->toDateString();
            $ingreso= Carbon::parse($request->fechaIngreso)->toDateString();
            $productor = new Productor();
            $productor->fechaExpedicion =$mytime;
            $productor->fechaNacimiento = $nacimiento;
            $productor->sexo_id = $request->sexo_id;
            $productor->departamento_id = $request->departamento_id;
            $productor->municipio_id = $request->municipio_id;
            $productor->vereda = $request->vereda;
            $productor->fechaIngreso = $ingreso;
            $productor->id = $persona->id;
            $productor->save();

            $user= new User();
            $user->usuario= $persona->num_documento;
            $user->password= bcrypt($persona->num_documento);
            $user->condicion='1';
            $user->idrol='4';
            $user->id= $persona->id;
            $user->save();

            DB::commit();
        }catch(Exception $e){
            DB::rollback();
        }
    }

    public function update(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        try{
        DB::beginTransaction();
        $productor =Productor::findOrFail($request->id);
        $persona =Persona::findorFail($productor->id);
        $user= User::findOrFail($productor->id);

        $persona->nombre = $request->nombre;
        $persona->tipo_id = $request->tipo_id;
        $persona->num_documento = $request->num_documento;
        $persona->direccion = $request->direccion;
        $persona->telefono = $request->telefono;
        $persona->email = $request->email;
        $persona->save();

        $mytime= Carbon::parse($request->fechaExpedicion)->toDateString();
        $nacimiento= Carbon::parse($request->fechaNacimiento)->toDateString();
        $ingreso= Carbon::parse($request->fechaIngreso)->toDateString();

        $productor->fechaExpedicion = $mytime;
        $productor->fechaNacimiento = $nacimiento;
        $productor->sexo_id = $request->sexo_id;
        $productor->departamento_id = $request->departamento_id;
        $productor->municipio_id = $request->municipio_id;
        $productor->vereda = $request->vereda;
        $productor->fechaIngreso = $ingreso;
        $productor->save();



        DB::commit();
        }
        catch(Exception $e){
            DB::rollback();
        }
    }
    public function selectProductor(Request $request){
        //if(!$request->ajax()) return redirect('/');
        $personas= Productor::join('personas','productors.id','=','personas.id')
        ->select('productors.id','personas.nombre')->orderBy('productors.id','asc')->get();
        return['personas'=>$personas];
    }

    public function selectProductor2(Request $request){
        //if(!$request->ajax()) return redirect('/');
        $filtro = $request->filtro;
        $personas= Productor::join('personas','productors.id','=','personas.id')
        ->where('personas.nombre', 'like', '%'. $filtro . '%')
        ->orWhere('personas.num_documento', 'like', '%'. $filtro . '%')
        ->select('productors.id','personas.nombre','personas.num_documento')
        ->orderBy('personas.nombre', 'asc')->get();
        return['personas'=>$personas];
    }

    public function listarPdf(Request $request)
    {
        $ahora= Carbon::now('America/Bogota');        
        $personas= Productor::join('personas','productors.id','=','personas.id')
            ->join('sexos','productors.sexo_id','=','sexos.id')
            ->join('etnias','productors.etnia_id','=','etnias.id')
            ->join('gradoEscolaridads','productors.escolaridad_id','=','gradoEscolaridads.id')
            ->join('departamentos','productors.departamento_id','=','departamentos.id')
            ->join('municipios','productors.municipio_id','=','municipios.id')
            ->join('veredas','productors.vereda_id','=','veredas.id')
            ->join('resguardos','productors.resguardo_id','=','resguardos.id')
            ->select('personas.id','personas.nombre','personas.tipo_id','personas.num_documento','personas.direccion','personas.telefono','personas.email',
            'productors.fechaExpedicion','productors.fechaNacimiento','productors.sexo_id','sexos.nombre as nombre_sexo',
            'productors.etnia_id','etnias.nombre as nombre_etnia','productors.escolaridad_id','gradoEscolaridads.nombre as nombre_escolaridad',
            'productors.departamento_id','departamentos.nombre as nombre_departamento','productors.municipio_id','municipios.nombre as nombre_municipio',
            'productors.vereda_id','veredas.nombre as nombre_vereda','productors.resguardo_id','resguardos.nombre as nombre_resguardo','productors.fechaIngreso',
            'productors.fotocopiaCedula')
            ->orderBy('productors.id','desc')->get();
            $cont=Productor::count();

            $pdf = \PDF::loadView('pdf.productores',['personas'=>$personas,'cont'=>$cont,'ahora'=>$ahora])->setPaper('a4', 'landscape');
            return $pdf->download('productores.pdf');
       
    }

    public function excel(Request $request)
    {       
        $personas= Productor::join('personas','productors.id','=','personas.id')
            ->join('sexos','productors.sexo_id','=','sexos.id')
            ->join('etnias','productors.etnia_id','=','etnias.id')
            ->join('gradoEscolaridads','productors.escolaridad_id','=','gradoEscolaridads.id')
            ->join('departamentos','productors.departamento_id','=','departamentos.id')
            ->join('municipios','productors.municipio_id','=','municipios.id')
            ->join('veredas','productors.vereda_id','=','veredas.id')
            ->join('resguardos','productors.resguardo_id','=','resguardos.id')
            ->select('personas.id','personas.nombre','personas.tipo_id','personas.num_documento','personas.direccion','personas.telefono','personas.email',
            'productors.fechaExpedicion','productors.fechaNacimiento','productors.sexo_id','sexos.nombre as nombre_sexo',
            'productors.etnia_id','etnias.nombre as nombre_etnia','productors.escolaridad_id','gradoEscolaridads.nombre as nombre_escolaridad',
            'productors.departamento_id','departamentos.nombre as nombre_departamento','productors.municipio_id','municipios.nombre as nombre_municipio',
            'productors.vereda_id','veredas.nombre as nombre_vereda','productors.resguardo_id','resguardos.nombre as nombre_resguardo','productors.fechaIngreso',
            'productors.fotocopiaCedula')
            ->orderBy('productors.id','desc')->get();
            
            return [
                'personas' => $personas
            ];
       
    }

}
