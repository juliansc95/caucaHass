<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Persona;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar == ''){
            $personas= User::join('personas','users.id','=','personas.id')
            ->join('roles','users.idrol','=','roles.id')
            ->select('personas.id','personas.nombre','personas.tipo_id','personas.num_documento',
            'personas.direccion','personas.telefono','personas.email','users.usuario','users.password',
            'users.condicion','users.idrol','roles.nombre as rol')
            ->orderBy('personas.id','desc')->paginate(10);
        }
        if($criterio == 'usuario'){
            $personas= User::join('personas','users.id','=','personas.id')
            ->join('roles','users.idrol','=','roles.id')
            ->select('personas.id','personas.nombre','personas.tipo_id','personas.num_documento',
            'personas.direccion','personas.telefono','personas.email','users.usuario','users.password',
            'users.condicion','users.idrol','roles.nombre as rol')
            ->where('users.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('personas.id', 'desc')->paginate(10);    
        }
        else{
            $personas= User::join('personas','users.id','=','personas.id')
            ->join('roles','users.idrol','=','roles.id')
            ->select('personas.id','personas.nombre','personas.tipo_id','personas.num_documento',
            'personas.direccion','personas.telefono','personas.email','users.usuario','users.password',
            'users.condicion','users.idrol','roles.nombre as rol')
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

    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');

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

        $user= new User();
        $user->usuario= $request->usuario;
        $user->password= bcrypt($request->password);
        $user->condicion='1';
        $user->idrol=$request->idrol;
        $user->id= $persona->id;
        $user->save();
        DB::commit();    
        } catch(Exception $e){
            DB::rollBack();
        }
    }

    public function update(Request $request)
    {      
        if(!$request->ajax()) return redirect('/');
        try{
        DB::beginTransaction();

        $user= User::findOrFail($request->id);    

        $persona = Persona::findOrFail($user->id);
        
        $persona->nombre = $request->nombre;
        $persona->tipo_id = $request->tipo_id;
        $persona->num_documento = $request->num_documento;
        $persona->direccion = $request->direccion;
        $persona->telefono = $request->telefono;
        $persona->email = $request->email;
        $persona->save();
        

        $user->usuario= $request->usuario;
        $user->password= bcrypt($request->password);
        $user->condicion='1';
        $user->idrol=$request->idrol;
        $user->save();
        DB::commit();    


        }catch(Exception $e){
            DB::rollback();
        }
    }

    public function desactivar(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $user = User::findOrFail($request->id);
        $user->condicion = '0';
        $user->save();
    }

    public function activar(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $user = User::findOrFail($request->id);
        $user->condicion = '1';
        $user->save();
    }

    public function listarPdf(Request $request)
    {
        $ahora= Carbon::now('America/Bogota');
        $cont=User::count();
        $personas= User::join('personas','users.id','=','personas.id')
            ->join('roles','users.idrol','=','roles.id')
            ->select('personas.id','personas.nombre','personas.tipo_id','personas.num_documento',
            'personas.direccion','personas.telefono','personas.email','users.usuario','users.password',
            'users.condicion','users.idrol','roles.nombre as rol')
            ->orderBy('personas.id','desc')->get();
            $pdf = \PDF::loadView('pdf.usuarios',['personas'=>$personas,'cont'=>$cont,'ahora'=>$ahora])->setPaper('a4', 'landscape');
            return $pdf->download('usuarios.pdf');
       
    }

    public function excel(Request $request)
    {
        $personas= User::join('personas','users.id','=','personas.id')
            ->join('roles','users.idrol','=','roles.id')
            ->select('personas.id','personas.nombre','personas.tipo_id','personas.num_documento',
            'personas.direccion','personas.telefono','personas.email','users.usuario','users.password',
            'users.condicion','users.idrol','roles.nombre as rol')
            ->orderBy('personas.id','desc')->get();
            return [
                'personas' => $personas
            ];
    }


}
