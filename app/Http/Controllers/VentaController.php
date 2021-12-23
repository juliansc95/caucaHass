<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Venta;
use App\VentaCategoria;

class VentaController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        
        if ($buscar==''){
            $id = $request->id;
            $ventas = Venta::join('personas','ventas.productor_id','=','personas.id')
            ->join('productors','ventas.productor_id','=','productors.id')
            ->join('estadoVentas','ventas.estado_id','=','estadoVentas.id')
            ->join('lugarVentas','ventas.lugarVenta_id','=','lugarVentas.id')
            ->join('lineas','ventas.linea_id','=','lineas.id')
            ->select('ventas.id','ventas.productor_id','ventas.linea_id',
            'ventas.fechaVenta','ventas.lugarVenta_id','ventas.totalVenta','ventas.totalKilos',
            'ventas.estado_id','personas.nombre as nombre_persona','estadoVentas.nombre as nombre_estadoVenta',
            'lugarVentas.nombre as nombre_lugarVenta','lineas.nombre as nombre_linea')
             ->orderBy('ventas.estado_id', 'asc')->paginate(10);
        }
        if($criterio == 'personas'){
        $ventas = Venta::join('personas','ventas.productor_id','=','personas.id')
        ->join('productors','ventas.productor_id','=','productors.id')
        ->join('estadoVentas','ventas.estado_id','=','estadoVentas.id')
        ->join('lugarVentas','ventas.lugarVenta_id','=','lugarVentas.id')
        ->join('lineas','ventas.linea_id','=','lineas.id')
        ->select('ventas.id','ventas.productor_id','ventas.linea_id',
        'ventas.fechaVenta','ventas.lugarVenta_id','ventas.totalVenta','ventas.totalKilos',
        'ventas.estado_id','personas.nombre as nombre_persona','estadoVentas.nombre as nombre_estadoVenta',
        'lugarVentas.nombre as nombre_lugarVenta','lineas.nombre as nombre_linea')
        ->where($criterio.'.nombre', 'like', '%'. $buscar . '%')
        ->orderBy('ventas.estado_id', 'asc')->paginate(10);
        }
        else{
            $ventas = Venta::join('personas','ventas.productor_id','=','personas.id')
            ->join('productors','ventas.productor_id','=','productors.id')
            ->join('estadoVentas','ventas.estado_id','=','estadoVentas.id')
            ->join('lugarVentas','ventas.lugarVenta_id','=','lugarVentas.id')
            ->join('lineas','ventas.linea_id','=','lineas.id')
            ->select('ventas.id','ventas.productor_id','ventas.linea_id',
            'ventas.fechaVenta','ventas.lugarVenta_id','ventas.totalVenta','ventas.totalKilos',
            'ventas.estado_id','personas.nombre as nombre_persona','estadoVentas.nombre as nombre_estadoVenta',
            'lugarVentas.nombre as nombre_lugarVenta','lineas.nombre as nombre_linea')
            ->where('ventas.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('ventas.estado_id', 'asc')->paginate(10);
        }
        
        return [
            'pagination' => [
                'total'        => $ventas->total(),
                'current_page' => $ventas->currentPage(),
                'per_page'     => $ventas->perPage(),
                'last_page'    => $ventas->lastPage(),
                'from'         => $ventas->firstItem(),
                'to'           => $ventas->lastItem(),
            ],
            'ventas' => $ventas
        ];
    }

    public function indexProductor(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        $user = \Auth::user()->id;
        
        if ($buscar==''){
            $id = $request->id;
            $ventas = Venta::join('personas','ventas.productor_id','=','personas.id')
            ->join('productors','ventas.productor_id','=','productors.id')
            ->join('estadoVentas','ventas.estado_id','=','estadoVentas.id')
            ->join('lugarVentas','ventas.lugarVenta_id','=','lugarVentas.id')
            ->join('lineas','ventas.linea_id','=','lineas.id')
            ->select('ventas.id','ventas.productor_id','ventas.linea_id',
            'ventas.fechaVenta','ventas.lugarVenta_id','ventas.totalVenta','ventas.totalKilos',
            'ventas.estado_id','personas.nombre as nombre_persona','estadoVentas.nombre as nombre_estadoVenta',
            'lugarVentas.nombre as nombre_lugarVenta','lineas.nombre as nombre_linea')
            ->where('ventas.productor_id','=',$user)
            ->orderBy('ventas.estado_id', 'asc')->paginate(10);
        }
        if($criterio == 'personas'){
        $ventas = Venta::join('personas','ventas.productor_id','=','personas.id')
        ->join('productors','ventas.productor_id','=','productors.id')
        ->join('estadoVentas','ventas.estado_id','=','estadoVentas.id')
        ->join('lugarVentas','ventas.lugarVenta_id','=','lugarVentas.id')
        ->join('lineas','ventas.linea_id','=','lineas.id')
        ->select('ventas.id','ventas.productor_id','ventas.linea_id',
        'ventas.fechaVenta','ventas.lugarVenta_id','ventas.totalVenta','ventas.totalKilos',
        'ventas.estado_id','personas.nombre as nombre_persona','estadoVentas.nombre as nombre_estadoVenta',
        'lugarVentas.nombre as nombre_lugarVenta','lineas.nombre as nombre_linea')
        ->where('ventas.productor_id','=',$user)
        ->where($criterio.'.nombre', 'like', '%'. $buscar . '%')
        ->orderBy('ventas.estado_id', 'asc')->paginate(10);
        }
        else{
            $ventas = Venta::join('personas','ventas.productor_id','=','personas.id')
            ->join('productors','ventas.productor_id','=','productors.id')
            ->join('estadoVentas','ventas.estado_id','=','estadoVentas.id')
            ->join('lugarVentas','ventas.lugarVenta_id','=','lugarVentas.id')
            ->join('lineas','ventas.linea_id','=','lineas.id')
            ->select('ventas.id','ventas.productor_id','ventas.linea_id',
            'ventas.fechaVenta','ventas.lugarVenta_id','ventas.totalVenta','ventas.totalKilos',
            'ventas.estado_id','personas.nombre as nombre_persona','estadoVentas.nombre as nombre_estadoVenta',
            'lugarVentas.nombre as nombre_lugarVenta','lineas.nombre as nombre_linea')
            ->where('ventas.productor_id','=',$user)
            ->where('ventas.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('ventas.estado_id', 'asc')->paginate(10);
        }
        
        return [
            'pagination' => [
                'total'        => $ventas->total(),
                'current_page' => $ventas->currentPage(),
                'per_page'     => $ventas->perPage(),
                'last_page'    => $ventas->lastPage(),
                'from'         => $ventas->firstItem(),
                'to'           => $ventas->lastItem(),
            ],
            'ventas' => $ventas
        ];
    }

    public function obtenerCabecera(Request $request){
        if (!$request->ajax()) return redirect('/');

        $id = $request->id;
        $venta = Venta::join('personas','ventas.productor_id','=','personas.id')
        ->join('productors','ventas.productor_id','=','productors.id')
        ->join('estadoVentas','ventas.estado_id','=','estadoVentas.id')
        ->join('lugarVentas','ventas.lugarVenta_id','=','lugarVentas.id')
        ->join('lineas','ventas.linea_id','=','lineas.id')
        ->select('ventas.id','ventas.productor_id','ventas.linea_id',
        'ventas.fechaVenta','ventas.lugarVenta_id','ventas.totalVenta','ventas.totalKilos',
        'ventas.estado_id','ventas.totalDonacion','ventas.totalTransporte',
        'ventas.totalAsohof','ventas.totalCuatroXmil',
        'personas.nombre as nombre_persona','estadoVentas.nombre as nombre_estadoVenta',
        'lugarVentas.nombre as nombre_lugarVenta','lineas.nombre as nombre_linea')
        ->where('ventas.id','=',$id)
        ->orderBy('ventas.id', 'desc')->take(1)->get();
        
        return ['venta' => $venta];
    }
    public function obtenerVentaCategoria(Request $request){
        if (!$request->ajax()) return redirect('/');

        $id = $request->id;
        $ventaCategoria = VentaCategoria::join('categoriaMoras','ventas_categorias.categoria_id','=','categoriaMoras.id')
        ->select('ventas_categorias.peso','ventas_categorias.valorUnitario','ventas_categorias.subtotal',
        'categoriaMoras.nombre as nombre_categoria')
        ->where('ventas_categorias.ventas_id','=',$id)
        ->orderBy('ventas_categorias.id', 'desc')->get();
        
        return ['ventaCategoria' => $ventaCategoria];
    }

    public function pdf(Request $request,$id){
        $venta = Venta::join('personas','ventas.productor_id','=','personas.id')
        ->join('productors','ventas.productor_id','=','productors.id')
        ->join('estadoVentas','ventas.estado_id','=','estadoVentas.id')
        ->join('lugarVentas','ventas.lugarVenta_id','=','lugarVentas.id')
        ->join('lineas','ventas.linea_id','=','lineas.id')
        ->select('ventas.id','ventas.productor_id','ventas.linea_id',
        'ventas.fechaVenta','ventas.lugarVenta_id','ventas.totalVenta','ventas.totalKilos',
        'ventas.estado_id','ventas.totalDonacion','ventas.totalTransporte',
        'ventas.totalAsohof','ventas.totalCuatroXmil',
        'personas.nombre as nombre_persona','personas.num_documento as num_documento',
        'estadoVentas.nombre as nombre_estadoVenta','personas.direccion as direccion',
        'personas.telefono as telefono', 'personas.telefono as telefono','personas.email as email',
        'lugarVentas.nombre as nombre_lugarVenta','lineas.nombre as nombre_linea')
        ->where('ventas.id','=',$id)
        ->orderBy('ventas.id', 'desc')->take(1)->get();

        $ventaCategoria = VentaCategoria::join('categoriaMoras','ventas_categorias.categoria_id','=','categoriaMoras.id')
        ->select('ventas_categorias.peso','ventas_categorias.valorUnitario','ventas_categorias.subtotal',
        'categoriaMoras.nombre as nombre_categoria')
        ->where('ventas_categorias.ventas_id','=',$id)
        ->orderBy('ventas_categorias.id', 'desc')->get();

        $nombrePdf=Venta::select('ventas.fechaVenta')
        ->where('id',$id)->get();

        $pdf = \PDF::loadView('pdf.venta',['venta'=>$venta,'ventaCategoria' => $ventaCategoria]);
        return $pdf->download('venta-'.$nombrePdf[0]->fechaVenta.'.pdf');
    }

    public function listarPdf(){
        $ahora= Carbon::now('America/Bogota');
        $ventas = Venta::join('personas','ventas.productor_id','=','personas.id')
        ->join('productors','ventas.productor_id','=','productors.id')
        ->join('estadoVentas','ventas.estado_id','=','estadoVentas.id')
        ->join('lugarVentas','ventas.lugarVenta_id','=','lugarVentas.id')
        ->join('lineas','ventas.linea_id','=','lineas.id')
        ->select('ventas.id','ventas.productor_id','ventas.linea_id',
        'ventas.fechaVenta','ventas.lugarVenta_id','ventas.totalVenta','ventas.totalKilos',
        'ventas.estado_id','ventas.totalDonacion','ventas.totalTransporte',
        'ventas.totalAsohof','ventas.totalCuatroXmil',
        'personas.nombre as nombre_persona','personas.num_documento as num_documento',
        'estadoVentas.nombre as nombre_estadoVenta','personas.direccion as direccion',
        'personas.telefono as telefono', 'personas.telefono as telefono','personas.email as email',
        'lugarVentas.nombre as nombre_lugarVenta','lineas.nombre as nombre_linea')
        ->orderBy('ventas.id', 'desc')->get();
        $cont=Venta::count();

        $pdf = \PDF::loadView('pdf.ventas',['ventas'=>$ventas,'cont'=>$cont,'ahora'=>$ahora])->setPaper('a4', 'landscape');
        return $pdf->download('ventas.pdf');
    }

    public function listarPdfDiario(){
        
        $ahora= Carbon::now('America/Bogota');
        $today= Carbon::now('America/Bogota')->toDateString();

        $tomorrow= new Carbon('tomorrow');

        $ventas = Venta::join('personas','ventas.productor_id','=','personas.id')
        ->join('productors','ventas.productor_id','=','productors.id')
        ->join('estadoVentas','ventas.estado_id','=','estadoVentas.id')
        ->join('lugarVentas','ventas.lugarVenta_id','=','lugarVentas.id')
        ->join('lineas','ventas.linea_id','=','lineas.id')
        ->select('ventas.id','ventas.productor_id','ventas.linea_id',
        'ventas.fechaVenta','ventas.lugarVenta_id','ventas.totalVenta','ventas.totalKilos',
        'ventas.estado_id','ventas.totalDonacion','ventas.totalTransporte',
        'ventas.totalAsohof','ventas.totalCuatroXmil',
        'personas.nombre as nombre_persona','personas.num_documento as num_documento',
        'estadoVentas.nombre as nombre_estadoVenta','personas.direccion as direccion',
        'personas.telefono as telefono', 'personas.telefono as telefono','personas.email as email',
        'lugarVentas.nombre as nombre_lugarVenta','lineas.nombre as nombre_linea')
        ->whereBetween('fechaVenta',[$today,$tomorrow])
        ->orderBy('ventas.id', 'desc')->get();
        $cont=count($ventas);

        $pdf = \PDF::loadView('pdf.ventas',['ventas'=>$ventas,'cont'=>$cont,'ahora'=>$ahora])->setPaper('a4', 'landscape');
        return $pdf->download('ventas'.$today.'.pdf');
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        try{
            DB::beginTransaction();

            $mytime= Carbon::now('America/Lima');

            $venta = new Venta();
            $venta->productor_id = $request->productor_id;
            $venta->linea_id = $request->linea_id;
            $venta->fechaVenta = $mytime->toDateTimeString();
            $venta->lugarVenta_id = $request->lugarVenta_id;
            $venta->totalVenta = $request->totalVenta;
            $venta->totalKilos = $request->totalKilos;
            $venta->totalDonacion = $request->totalDonacion; 
            $venta->totalTransporte = $request->totalTransporte;   
            $venta->totalAsohof = $request->totalAsohof;
            $venta->totalCuatroXmil =$request->totalCuatroXmil;
            $venta->estado_id = '1';
            $venta->save();

            $ventaCategorias = $request->data;//Array de detalles
            //Recorro todos los elementos

            foreach($ventaCategorias as $ep=>$ventaCat)
            {
                $ventaCategoria = new VentaCategoria();
                $ventaCategoria->ventas_id = $venta->id;
                $ventaCategoria->categoria_id = $ventaCat['categoria_id'];
                $ventaCategoria->peso = $ventaCat['peso'];
                $ventaCategoria->valorUnitario = $ventaCat['valorUnitario'];
                $ventaCategoria->subtotal = $ventaCat['subtotal'];    
                $ventaCategoria->save();
            }          

            DB::commit();
            return[
                'id'=>$venta->id
            ];
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $venta = Venta::findOrFail($request->id);
        $venta->estado_id = '5';
        $venta->save();
    }

    public function pasarFacturacion(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $venta = Venta::findOrFail($request->id);
        $venta->estado_id = '2';
        $venta->save();
    }

    public function pasarDisponiblePago(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $venta = Venta::findOrFail($request->id);
        $venta->estado_id = '3';
        $venta->save();
    }

    public function pasarPagado(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $venta = Venta::findOrFail($request->id);
        $venta->estado_id = '4';
        $venta->save();
    }

    public function excel(){
        $ventas = Venta::join('personas','ventas.productor_id','=','personas.id')
        ->join('productors','ventas.productor_id','=','productors.id')
        ->join('estadoVentas','ventas.estado_id','=','estadoVentas.id')
        ->join('lugarVentas','ventas.lugarVenta_id','=','lugarVentas.id')
        ->join('lineas','ventas.linea_id','=','lineas.id')
        ->select('ventas.id','ventas.productor_id','ventas.linea_id',
        'ventas.fechaVenta','ventas.lugarVenta_id','ventas.totalVenta','ventas.totalKilos',
        'ventas.estado_id','ventas.totalDonacion','ventas.totalTransporte',
        'ventas.totalAsohof','ventas.totalCuatroXmil',
        'personas.nombre as nombre_persona','personas.num_documento as num_documento',
        'estadoVentas.nombre as nombre_estadoVenta','personas.direccion as direccion',
        'personas.telefono as telefono', 'personas.telefono as telefono','personas.email as email',
        'lugarVentas.nombre as nombre_lugarVenta','lineas.nombre as nombre_linea')
        ->orderBy('ventas.id', 'desc')->get();
        return [
            'ventas' => $ventas
        ];
        
    }

}
