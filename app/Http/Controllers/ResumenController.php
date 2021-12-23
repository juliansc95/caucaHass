<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\EstablecimientoConcepto;
use App\GastosProduccion;
use App\ProduccionConcepto;
use App\RenovacionConcepto;
use App\Venta;


class ResumenController extends Controller
{
    public function index(Request $request)
    {
            
             //Enero
             $EneroProduccion = ProduccionConcepto::join('gastosproduccions','produccionconceptos.gastosProduccion_id','=','gastosproduccions.id')
             ->whereBetween('gastosproduccions.fechaRegistro',['2021-01-01','2021-01-31'])
             ->sum('produccionconceptos.valorTotal');
             $EneroRenovacion = RenovacionConcepto::join('adecuacionrenovacions','renovacionconceptos.adecuacionrenovacion_id','=','adecuacionrenovacions.id')
             ->whereBetween('adecuacionrenovacions.fechaRegistro',['2021-01-01','2021-01-31'])
             ->sum('renovacionconceptos.valorTotal');
             $EneroEstablecimiento = EstablecimientoConcepto::join('gastosestablecimientos','establecimientoconceptos.gastosEstablecimiento_id','=','gastosestablecimientos.id')
             ->whereBetween('gastosestablecimientos.fechaRegistro',['2021-01-01','2021-01-31'])
             ->sum('establecimientoconceptos.valorTotal');
             $gastosEnero = $EneroProduccion +  $EneroRenovacion + $EneroEstablecimiento;
             $ventasEnero = Venta:: whereBetween('ventas.fechaVenta',['2021-01-01','2021-01-31'])
             ->sum('ventas.totalVenta');
             $utilidadEnero = $ventasEnero - $gastosEnero; 

             //Febrero
             $FebreroProduccion = ProduccionConcepto::join('gastosproduccions','produccionconceptos.gastosProduccion_id','=','gastosproduccions.id')
             ->whereBetween('gastosproduccions.fechaRegistro',['2021-02-01','2021-02-28'])
             ->sum('produccionconceptos.valorTotal');
             $FebreroRenovacion = RenovacionConcepto::join('adecuacionrenovacions','renovacionconceptos.adecuacionrenovacion_id','=','adecuacionrenovacions.id')
             ->whereBetween('adecuacionrenovacions.fechaRegistro',['2021-02-01','2021-02-28'])
             ->sum('renovacionconceptos.valorTotal');
             $FebreroEstablecimiento = EstablecimientoConcepto::join('gastosestablecimientos','establecimientoconceptos.gastosEstablecimiento_id','=','gastosestablecimientos.id')
             ->whereBetween('gastosestablecimientos.fechaRegistro',['2021-02-01','2021-02-28'])
             ->sum('establecimientoconceptos.valorTotal');
             $gastosFebrero = $FebreroProduccion +  $FebreroRenovacion + $FebreroEstablecimiento;
             $ventasFebrero = Venta:: whereBetween('ventas.fechaVenta',['2021-02-01','2021-02-28'])
             ->sum('ventas.totalVenta');
             $utilidadFebrero = $ventasFebrero - $gastosFebrero; 

            //Marzo
            $MarzoProduccion = ProduccionConcepto::join('gastosproduccions','produccionconceptos.gastosProduccion_id','=','gastosproduccions.id')
            ->whereBetween('gastosproduccions.fechaRegistro',['2021-03-01','2021-03-31'])
            ->sum('produccionconceptos.valorTotal');
            $MarzoRenovacion = RenovacionConcepto::join('adecuacionrenovacions','renovacionconceptos.adecuacionrenovacion_id','=','adecuacionrenovacions.id')
            ->whereBetween('adecuacionrenovacions.fechaRegistro',['2021-03-01','2021-03-31'])
            ->sum('renovacionconceptos.valorTotal');
            $MarzoEstablecimiento = EstablecimientoConcepto::join('gastosestablecimientos','establecimientoconceptos.gastosEstablecimiento_id','=','gastosestablecimientos.id')
            ->whereBetween('gastosestablecimientos.fechaRegistro',['2021-03-01','2021-03-31'])
            ->sum('establecimientoconceptos.valorTotal');
            $gastosMarzo = $MarzoProduccion +  $MarzoRenovacion + $MarzoEstablecimiento;
            $ventasMarzo = Venta:: whereBetween('ventas.fechaVenta',['2021-03-01','2021-03-31'])
            ->sum('ventas.totalVenta');
            $utilidadMarzo = $ventasMarzo - $gastosMarzo; 


            //Abril
            $AbrilProduccion = ProduccionConcepto::join('gastosproduccions','produccionconceptos.gastosProduccion_id','=','gastosproduccions.id')
            ->whereBetween('gastosproduccions.fechaRegistro',['2021-04-01','2021-04-30'])
            ->sum('produccionconceptos.valorTotal');
            $AbrilRenovacion = RenovacionConcepto::join('adecuacionrenovacions','renovacionconceptos.adecuacionrenovacion_id','=','adecuacionrenovacions.id')
            ->whereBetween('adecuacionrenovacions.fechaRegistro',['2021-04-01','2021-04-30'])
            ->sum('renovacionconceptos.valorTotal');
            $AbrilEstablecimiento = EstablecimientoConcepto::join('gastosestablecimientos','establecimientoconceptos.gastosEstablecimiento_id','=','gastosestablecimientos.id')
            ->whereBetween('gastosestablecimientos.fechaRegistro',['2021-04-01','2021-04-30'])
            ->sum('establecimientoconceptos.valorTotal');
            $gastosAbril = $AbrilProduccion +  $AbrilRenovacion + $AbrilEstablecimiento;
            $ventasAbril = Venta:: whereBetween('ventas.fechaVenta',['2021-04-01','2021-04-30'])
            ->sum('ventas.totalVenta');
            $utilidadAbril = $ventasAbril - $gastosAbril; 

            //Mayo
            $MayoProduccion = ProduccionConcepto::join('gastosproduccions','produccionconceptos.gastosProduccion_id','=','gastosproduccions.id')
            ->whereBetween('gastosproduccions.fechaRegistro',['2021-05-01','2021-05-31'])
            ->sum('produccionconceptos.valorTotal');
            $MayoRenovacion = RenovacionConcepto::join('adecuacionrenovacions','renovacionconceptos.adecuacionrenovacion_id','=','adecuacionrenovacions.id')
            ->whereBetween('adecuacionrenovacions.fechaRegistro',['2021-05-01','2021-05-31'])
            ->sum('renovacionconceptos.valorTotal');
            $MayoEstablecimiento = EstablecimientoConcepto::join('gastosestablecimientos','establecimientoconceptos.gastosEstablecimiento_id','=','gastosestablecimientos.id')
            ->whereBetween('gastosestablecimientos.fechaRegistro',['2021-05-01','2021-05-31'])
            ->sum('establecimientoconceptos.valorTotal');
            $gastosMayo = $MayoProduccion +  $MayoRenovacion + $MayoEstablecimiento;
            $ventasMayo = Venta:: whereBetween('ventas.fechaVenta',['2021-05-01','2021-05-31'])
            ->sum('ventas.totalVenta');
            $utilidadMayo = $ventasMayo - $gastosMayo; 

            //Junio
            $JunioProduccion = ProduccionConcepto::join('gastosproduccions','produccionconceptos.gastosProduccion_id','=','gastosproduccions.id')
            ->whereBetween('gastosproduccions.fechaRegistro',['2021-06-01','2021-06-30'])
            ->sum('produccionconceptos.valorTotal');
            $JunioRenovacion = RenovacionConcepto::join('adecuacionrenovacions','renovacionconceptos.adecuacionrenovacion_id','=','adecuacionrenovacions.id')
            ->whereBetween('adecuacionrenovacions.fechaRegistro',['2021-06-01','2021-06-30'])
            ->sum('renovacionconceptos.valorTotal');
            $JunioEstablecimiento = EstablecimientoConcepto::join('gastosestablecimientos','establecimientoconceptos.gastosEstablecimiento_id','=','gastosestablecimientos.id')
            ->whereBetween('gastosestablecimientos.fechaRegistro',['2021-06-01','2021-06-30'])
            ->sum('establecimientoconceptos.valorTotal');
            $gastosJunio = $JunioProduccion +  $JunioRenovacion + $JunioEstablecimiento;
            $ventasJunio = Venta:: whereBetween('ventas.fechaVenta',['2021-06-01','2021-06-30'])
            ->sum('ventas.totalVenta');
            $utilidadJunio = $ventasJunio - $gastosJunio; 

            //Julio
            $JulioProduccion = ProduccionConcepto::join('gastosproduccions','produccionconceptos.gastosProduccion_id','=','gastosproduccions.id')
            ->whereBetween('gastosproduccions.fechaRegistro',['2021-07-01','2021-07-31'])
            ->sum('produccionconceptos.valorTotal');
            $JulioRenovacion = RenovacionConcepto::join('adecuacionrenovacions','renovacionconceptos.adecuacionrenovacion_id','=','adecuacionrenovacions.id')
            ->whereBetween('adecuacionrenovacions.fechaRegistro',['2021-07-01','2021-07-31'])
            ->sum('renovacionconceptos.valorTotal');
            $JulioEstablecimiento = EstablecimientoConcepto::join('gastosestablecimientos','establecimientoconceptos.gastosEstablecimiento_id','=','gastosestablecimientos.id')
            ->whereBetween('gastosestablecimientos.fechaRegistro',['2021-07-01','2021-07-31'])
            ->sum('establecimientoconceptos.valorTotal');
            $gastosJulio = $JulioProduccion +  $JulioRenovacion + $JulioEstablecimiento;
            $ventasJulio = Venta:: whereBetween('ventas.fechaVenta',['2021-07-01','2021-07-31'])
            ->sum('ventas.totalVenta');
            $utilidadJulio = $ventasJulio - $gastosJulio; 

            //Agosto
            $AgostoProduccion = ProduccionConcepto::join('gastosproduccions','produccionconceptos.gastosProduccion_id','=','gastosproduccions.id')
            ->whereBetween('gastosproduccions.fechaRegistro',['2021-08-01','2021-08-31'])
            ->sum('produccionconceptos.valorTotal');
            $AgostoRenovacion = RenovacionConcepto::join('adecuacionrenovacions','renovacionconceptos.adecuacionrenovacion_id','=','adecuacionrenovacions.id')
            ->whereBetween('adecuacionrenovacions.fechaRegistro',['2021-08-01','2021-08-31'])
            ->sum('renovacionconceptos.valorTotal');
            $AgostoEstablecimiento = EstablecimientoConcepto::join('gastosestablecimientos','establecimientoconceptos.gastosEstablecimiento_id','=','gastosestablecimientos.id')
            ->whereBetween('gastosestablecimientos.fechaRegistro',['2021-08-01','2021-08-31'])
            ->sum('establecimientoconceptos.valorTotal');
            $gastosAgosto = $AgostoProduccion +  $AgostoRenovacion + $AgostoEstablecimiento;
            $ventasAgosto = Venta:: whereBetween('ventas.fechaVenta',['2021-08-01','2021-08-31'])
            ->sum('ventas.totalVenta');
            $utilidadAgosto = $ventasAgosto - $gastosAgosto; 

             //Septiembre
             $SeptiembreProduccion = ProduccionConcepto::join('gastosproduccions','produccionconceptos.gastosProduccion_id','=','gastosproduccions.id')
             ->whereBetween('gastosproduccions.fechaRegistro',['2021-09-01','2021-09-30'])
             ->sum('produccionconceptos.valorTotal');
             $SeptiembreRenovacion = RenovacionConcepto::join('adecuacionrenovacions','renovacionconceptos.adecuacionrenovacion_id','=','adecuacionrenovacions.id')
             ->whereBetween('adecuacionrenovacions.fechaRegistro',['2021-09-01','2021-09-30'])
             ->sum('renovacionconceptos.valorTotal');
             $SeptiembreEstablecimiento = EstablecimientoConcepto::join('gastosestablecimientos','establecimientoconceptos.gastosEstablecimiento_id','=','gastosestablecimientos.id')
             ->whereBetween('gastosestablecimientos.fechaRegistro',['2021-09-01','2021-09-30'])
             ->sum('establecimientoconceptos.valorTotal');
             $gastosSeptiembre = $SeptiembreProduccion +  $SeptiembreRenovacion + $SeptiembreEstablecimiento;
             $ventasSeptiembre = Venta:: whereBetween('ventas.fechaVenta',['2021-09-01','2021-09-30'])
             ->sum('ventas.totalVenta');
             $utilidadSeptiembre = $ventasSeptiembre - $gastosSeptiembre; 

            //Octubre
            $OctubreProduccion = ProduccionConcepto::join('gastosproduccions','produccionconceptos.gastosProduccion_id','=','gastosproduccions.id')
            ->whereBetween('gastosproduccions.fechaRegistro',['2021-10-01','2021-10-31'])
            ->sum('produccionconceptos.valorTotal');
            $OctubreRenovacion = RenovacionConcepto::join('adecuacionrenovacions','renovacionconceptos.adecuacionrenovacion_id','=','adecuacionrenovacions.id')
            ->whereBetween('adecuacionrenovacions.fechaRegistro',['2021-10-01','2021-10-31'])
            ->sum('renovacionconceptos.valorTotal');
            $OctubreEstablecimiento = EstablecimientoConcepto::join('gastosestablecimientos','establecimientoconceptos.gastosEstablecimiento_id','=','gastosestablecimientos.id')
            ->whereBetween('gastosestablecimientos.fechaRegistro',['2021-10-01','2021-10-31'])
            ->sum('establecimientoconceptos.valorTotal');
            $gastosOctubre = $OctubreProduccion +  $OctubreRenovacion + $OctubreEstablecimiento;
            $ventasOctubre = Venta:: whereBetween('ventas.fechaVenta',['2021-10-01','2021-10-31'])
            ->sum('ventas.totalVenta');
            $utilidadOctubre = $ventasOctubre - $gastosOctubre; 

      
        
            //Noviembre
            $NoviembreProduccion = ProduccionConcepto::join('gastosproduccions','produccionconceptos.gastosProduccion_id','=','gastosproduccions.id')
            ->whereBetween('gastosproduccions.fechaRegistro',['2021-11-01','2021-11-30'])
            ->sum('produccionconceptos.valorTotal');
            $NoviembreRenovacion = RenovacionConcepto::join('adecuacionrenovacions','renovacionconceptos.adecuacionrenovacion_id','=','adecuacionrenovacions.id')
            ->whereBetween('adecuacionrenovacions.fechaRegistro',['2021-11-01','2021-11-30'])
            ->sum('renovacionconceptos.valorTotal');
            $NoviembreEstablecimiento = EstablecimientoConcepto::join('gastosestablecimientos','establecimientoconceptos.gastosEstablecimiento_id','=','gastosestablecimientos.id')
            ->whereBetween('gastosestablecimientos.fechaRegistro',['2021-11-01','2021-11-30'])
            ->sum('establecimientoconceptos.valorTotal');
            $gastosNoviembre = $NoviembreProduccion +  $NoviembreRenovacion + $NoviembreEstablecimiento;
            $ventasNoviembre = Venta:: whereBetween('ventas.fechaVenta',['2021-11-01','2021-11-30'])
            ->sum('ventas.totalVenta');
            $utilidadNoviembre = $ventasNoviembre - $gastosNoviembre; 

            //Diciembre
            $DiciembreProduccion = ProduccionConcepto::join('gastosproduccions','produccionconceptos.gastosProduccion_id','=','gastosproduccions.id')
            ->whereBetween('gastosproduccions.fechaRegistro',['2021-12-01','2021-12-31'])
            ->sum('produccionconceptos.valorTotal');
            $DiciembreRenovacion = RenovacionConcepto::join('adecuacionrenovacions','renovacionconceptos.adecuacionrenovacion_id','=','adecuacionrenovacions.id')
            ->whereBetween('adecuacionrenovacions.fechaRegistro',['2021-12-01','2021-12-31'])
            ->sum('renovacionconceptos.valorTotal');
            $DiciembreEstablecimiento = EstablecimientoConcepto::join('gastosestablecimientos','establecimientoconceptos.gastosEstablecimiento_id','=','gastosestablecimientos.id')
            ->whereBetween('gastosestablecimientos.fechaRegistro',['2021-12-01','2021-12-31'])
            ->sum('establecimientoconceptos.valorTotal');
            $gastosDiciembre = $DiciembreProduccion +  $DiciembreRenovacion + $DiciembreEstablecimiento;
            $ventasDiciembre = Venta:: whereBetween('ventas.fechaVenta',['2021-12-01','2021-12-31'])
            ->sum('ventas.totalVenta');
            $utilidadDiciembre = $ventasDiciembre - $gastosDiciembre; 

            $totalIngresos = $ventasEnero+$ventasFebrero+$ventasMarzo+$ventasAbril+$ventasMayo+$ventasJunio+$ventasJulio+$ventasAgosto+$ventasSeptiembre+$ventasOctubre+$ventasNoviembre+$ventasDiciembre;
            $totalGastos = $gastosEnero+$gastosFebrero+$gastosMarzo+$gastosAbril+$gastosMayo+$gastosJunio+$gastosJulio+$gastosAgosto+$gastosSeptiembre+$gastosOctubre+$gastosNoviembre+$gastosDiciembre;
            $utilidadTotal = $utilidadEnero+$utilidadFebrero+$utilidadMarzo+$utilidadAbril+$utilidadMayo+$utilidadJunio+$utilidadJulio+$utilidadAgosto+$utilidadSeptiembre+$utilidadOctubre+$utilidadNoviembre+$utilidadDiciembre;
           
        return [
            
            'GastosEnero' =>  $gastosEnero,
            'ventasEnero'=>$ventasEnero,
            'utilidadEnero'=>$utilidadEnero,

            'GastosFebrero' =>  $gastosFebrero,
            'ventasFebrero'=>$ventasFebrero,
            'utilidadFebrero'=>$utilidadFebrero,

            'GastosMarzo' =>  $gastosMarzo,
            'ventasMarzo'=>$ventasMarzo,
            'utilidadMarzo'=>$utilidadMarzo,

            'GastosAbril' =>  $gastosAbril,
            'ventasAbril'=>$ventasAbril,
            'utilidadAbril'=>$utilidadAbril,

            'GastosMayo' =>  $gastosMayo,
            'ventasMayo'=>$ventasMayo,
            'utilidadMayo'=>$utilidadMayo,

            'GastosJunio' =>  $gastosJunio,
            'ventasJunio'=>$ventasJunio,
            'utilidadJunio'=>$utilidadJunio,

            'GastosJulio' =>  $gastosJulio,
            'ventasJulio'=>$ventasJulio,
            'utilidadJulio'=>$utilidadJulio,

            'GastosAgosto' =>  $gastosAgosto,
            'ventasAgosto'=>$ventasAgosto,
            'utilidadAgosto'=>$utilidadAgosto,

            'GastosSeptiembre' =>  $gastosSeptiembre,
            'ventasSeptiembre'=>$ventasSeptiembre,
            'utilidadSeptiembre'=>$utilidadSeptiembre,

            'GastosOctubre' =>  $gastosOctubre,
            'ventasOctubre'=>$ventasOctubre,
            'utilidadOctubre'=>$utilidadOctubre,

            'GastosNoviembre' =>  $gastosNoviembre,
            'ventasNoviembre'=>$ventasNoviembre,
            'utilidadNoviembre'=>$utilidadNoviembre,

            'GastosDiciembre' =>  $gastosDiciembre,
            'ventasDiciembre'=>$ventasDiciembre,
            'utilidadDiciembre'=>$utilidadDiciembre,

            'ingresosTotal' =>  $totalIngresos,
            'gastosTotal'=>$totalGastos,
            'utilidadTotal'=>$utilidadTotal,
        ];
    }
    
    
    public function indexProductor(Request $request)
    {
        $user = \Auth::user()->id; 
        //Enero
         $EneroProduccion = ProduccionConcepto::join('gastosproduccions','produccionconceptos.gastosProduccion_id','=','gastosproduccions.id')
         ->where('gastosproduccions.productor_id','=',$user)
         ->whereBetween('gastosproduccions.fechaRegistro',['2021-01-01','2021-01-31'])
         ->sum('produccionconceptos.valorTotal');
         $EneroRenovacion = RenovacionConcepto::join('adecuacionrenovacions','renovacionconceptos.adecuacionrenovacion_id','=','adecuacionrenovacions.id')
         ->where('adecuacionrenovacions.productor_id','=',$user) 
         ->whereBetween('adecuacionrenovacions.fechaRegistro',['2021-01-01','2021-01-31'])
         ->sum('renovacionconceptos.valorTotal');
         $EneroEstablecimiento = EstablecimientoConcepto::join('gastosestablecimientos','establecimientoconceptos.gastosEstablecimiento_id','=','gastosestablecimientos.id')
         ->where('gastosestablecimientos.productor_id','=',$user)  
         ->whereBetween('gastosestablecimientos.fechaRegistro',['2021-01-01','2021-01-31'])
         ->sum('establecimientoconceptos.valorTotal');
         $gastosEnero = $EneroProduccion +  $EneroRenovacion + $EneroEstablecimiento;
         $ventasEnero = Venta:: whereBetween('ventas.fechaVenta',['2021-01-01','2021-01-31'])
         ->where('ventas.productor_id','=',$user)
         ->sum('ventas.totalVenta');
         $utilidadEnero = $ventasEnero - $gastosEnero; 

         //Febrero
         $FebreroProduccion = ProduccionConcepto::join('gastosproduccions','produccionconceptos.gastosProduccion_id','=','gastosproduccions.id')
         ->where('gastosproduccions.productor_id','=',$user)
         ->whereBetween('gastosproduccions.fechaRegistro',['2021-02-01','2021-02-28'])
         ->sum('produccionconceptos.valorTotal');
         $FebreroRenovacion = RenovacionConcepto::join('adecuacionrenovacions','renovacionconceptos.adecuacionrenovacion_id','=','adecuacionrenovacions.id')
         ->where('adecuacionrenovacions.productor_id','=',$user) 
         ->whereBetween('adecuacionrenovacions.fechaRegistro',['2021-02-01','2021-02-28'])
         ->sum('renovacionconceptos.valorTotal');
         $FebreroEstablecimiento = EstablecimientoConcepto::join('gastosestablecimientos','establecimientoconceptos.gastosEstablecimiento_id','=','gastosestablecimientos.id')
         ->where('gastosestablecimientos.productor_id','=',$user)  
         ->whereBetween('gastosestablecimientos.fechaRegistro',['2021-02-01','2021-02-28'])
         ->sum('establecimientoconceptos.valorTotal');
         $gastosFebrero = $FebreroProduccion +  $FebreroRenovacion + $FebreroEstablecimiento;
         $ventasFebrero = Venta:: whereBetween('ventas.fechaVenta',['2021-02-01','2021-02-28'])
         ->where('ventas.productor_id','=',$user)
         ->sum('ventas.totalVenta');
         $utilidadFebrero = $ventasFebrero - $gastosFebrero; 

        //Marzo
        $MarzoProduccion = ProduccionConcepto::join('gastosproduccions','produccionconceptos.gastosProduccion_id','=','gastosproduccions.id')
        ->where('gastosproduccions.productor_id','=',$user)
        ->whereBetween('gastosproduccions.fechaRegistro',['2021-03-01','2021-03-31'])
        ->sum('produccionconceptos.valorTotal');
        $MarzoRenovacion = RenovacionConcepto::join('adecuacionrenovacions','renovacionconceptos.adecuacionrenovacion_id','=','adecuacionrenovacions.id')
        ->where('adecuacionrenovacions.productor_id','=',$user) 
        ->whereBetween('adecuacionrenovacions.fechaRegistro',['2021-03-01','2021-03-31'])
        ->sum('renovacionconceptos.valorTotal');
        $MarzoEstablecimiento = EstablecimientoConcepto::join('gastosestablecimientos','establecimientoconceptos.gastosEstablecimiento_id','=','gastosestablecimientos.id')
        ->where('gastosestablecimientos.productor_id','=',$user)  
        ->whereBetween('gastosestablecimientos.fechaRegistro',['2021-03-01','2021-03-31'])
        ->sum('establecimientoconceptos.valorTotal');
        $gastosMarzo = $MarzoProduccion +  $MarzoRenovacion + $MarzoEstablecimiento;
        $ventasMarzo = Venta:: whereBetween('ventas.fechaVenta',['2021-03-01','2021-03-31'])
        ->where('ventas.productor_id','=',$user)
        ->sum('ventas.totalVenta');
        $utilidadMarzo = $ventasMarzo - $gastosMarzo; 


        //Abril
        $AbrilProduccion = ProduccionConcepto::join('gastosproduccions','produccionconceptos.gastosProduccion_id','=','gastosproduccions.id')
        ->where('gastosproduccions.productor_id','=',$user)
        ->whereBetween('gastosproduccions.fechaRegistro',['2021-04-01','2021-04-30'])
        ->sum('produccionconceptos.valorTotal');
        $AbrilRenovacion = RenovacionConcepto::join('adecuacionrenovacions','renovacionconceptos.adecuacionrenovacion_id','=','adecuacionrenovacions.id')
        ->where('adecuacionrenovacions.productor_id','=',$user) 
        ->whereBetween('adecuacionrenovacions.fechaRegistro',['2021-04-01','2021-04-30'])
        ->sum('renovacionconceptos.valorTotal');
        $AbrilEstablecimiento = EstablecimientoConcepto::join('gastosestablecimientos','establecimientoconceptos.gastosEstablecimiento_id','=','gastosestablecimientos.id')
        ->where('gastosestablecimientos.productor_id','=',$user)  
        ->whereBetween('gastosestablecimientos.fechaRegistro',['2021-04-01','2021-04-30'])
        ->sum('establecimientoconceptos.valorTotal');
        $gastosAbril = $AbrilProduccion +  $AbrilRenovacion + $AbrilEstablecimiento;
        $ventasAbril = Venta:: whereBetween('ventas.fechaVenta',['2021-04-01','2021-04-30'])
        ->where('ventas.productor_id','=',$user)
        ->sum('ventas.totalVenta');
        $utilidadAbril = $ventasAbril - $gastosAbril; 

        //Mayo
        $MayoProduccion = ProduccionConcepto::join('gastosproduccions','produccionconceptos.gastosProduccion_id','=','gastosproduccions.id')
        ->where('gastosproduccions.productor_id','=',$user)
        ->whereBetween('gastosproduccions.fechaRegistro',['2021-05-01','2021-05-31'])
        ->sum('produccionconceptos.valorTotal');
        $MayoRenovacion = RenovacionConcepto::join('adecuacionrenovacions','renovacionconceptos.adecuacionrenovacion_id','=','adecuacionrenovacions.id')
        ->where('adecuacionrenovacions.productor_id','=',$user) 
        ->whereBetween('adecuacionrenovacions.fechaRegistro',['2021-05-01','2021-05-31'])
        ->sum('renovacionconceptos.valorTotal');
        $MayoEstablecimiento = EstablecimientoConcepto::join('gastosestablecimientos','establecimientoconceptos.gastosEstablecimiento_id','=','gastosestablecimientos.id')
        ->where('gastosestablecimientos.productor_id','=',$user)  
        ->whereBetween('gastosestablecimientos.fechaRegistro',['2021-05-01','2021-05-31'])
        ->sum('establecimientoconceptos.valorTotal');
        $gastosMayo = $MayoProduccion +  $MayoRenovacion + $MayoEstablecimiento;
        $ventasMayo = Venta:: whereBetween('ventas.fechaVenta',['2021-05-01','2021-05-31'])
        ->where('ventas.productor_id','=',$user)
        ->sum('ventas.totalVenta');
        $utilidadMayo = $ventasMayo - $gastosMayo; 

        //Junio
        $JunioProduccion = ProduccionConcepto::join('gastosproduccions','produccionconceptos.gastosProduccion_id','=','gastosproduccions.id')
        ->where('gastosproduccions.productor_id','=',$user)
        ->whereBetween('gastosproduccions.fechaRegistro',['2021-06-01','2021-06-30'])
        ->sum('produccionconceptos.valorTotal');
        $JunioRenovacion = RenovacionConcepto::join('adecuacionrenovacions','renovacionconceptos.adecuacionrenovacion_id','=','adecuacionrenovacions.id')
        ->where('adecuacionrenovacions.productor_id','=',$user) 
        ->whereBetween('adecuacionrenovacions.fechaRegistro',['2021-06-01','2021-06-30'])
        ->sum('renovacionconceptos.valorTotal');
        $JunioEstablecimiento = EstablecimientoConcepto::join('gastosestablecimientos','establecimientoconceptos.gastosEstablecimiento_id','=','gastosestablecimientos.id')
        ->where('gastosestablecimientos.productor_id','=',$user)  
        ->whereBetween('gastosestablecimientos.fechaRegistro',['2021-06-01','2021-06-30'])
        ->sum('establecimientoconceptos.valorTotal');
        $gastosJunio = $JunioProduccion +  $JunioRenovacion + $JunioEstablecimiento;
        $ventasJunio = Venta:: whereBetween('ventas.fechaVenta',['2021-06-01','2021-06-30'])
        ->where('ventas.productor_id','=',$user)
        ->sum('ventas.totalVenta');
        $utilidadJunio = $ventasJunio - $gastosJunio; 

        //Julio
        $JulioProduccion = ProduccionConcepto::join('gastosproduccions','produccionconceptos.gastosProduccion_id','=','gastosproduccions.id')
        ->where('gastosproduccions.productor_id','=',$user)
        ->whereBetween('gastosproduccions.fechaRegistro',['2021-07-01','2021-07-31'])
        ->sum('produccionconceptos.valorTotal');
        $JulioRenovacion = RenovacionConcepto::join('adecuacionrenovacions','renovacionconceptos.adecuacionrenovacion_id','=','adecuacionrenovacions.id')
        ->where('adecuacionrenovacions.productor_id','=',$user) 
        ->whereBetween('adecuacionrenovacions.fechaRegistro',['2021-07-01','2021-07-31'])
        ->sum('renovacionconceptos.valorTotal');
        $JulioEstablecimiento = EstablecimientoConcepto::join('gastosestablecimientos','establecimientoconceptos.gastosEstablecimiento_id','=','gastosestablecimientos.id')
        ->where('gastosestablecimientos.productor_id','=',$user)  
        ->whereBetween('gastosestablecimientos.fechaRegistro',['2021-07-01','2021-07-31'])
        ->sum('establecimientoconceptos.valorTotal');
        $gastosJulio = $JulioProduccion +  $JulioRenovacion + $JulioEstablecimiento;
        $ventasJulio = Venta:: whereBetween('ventas.fechaVenta',['2021-07-01','2021-07-31'])
        ->where('ventas.productor_id','=',$user)
        ->sum('ventas.totalVenta');
        $utilidadJulio = $ventasJulio - $gastosJulio; 

        //Agosto
        $AgostoProduccion = ProduccionConcepto::join('gastosproduccions','produccionconceptos.gastosProduccion_id','=','gastosproduccions.id')
        ->where('gastosproduccions.productor_id','=',$user)
        ->whereBetween('gastosproduccions.fechaRegistro',['2021-08-01','2021-08-31'])
        ->sum('produccionconceptos.valorTotal');
        $AgostoRenovacion = RenovacionConcepto::join('adecuacionrenovacions','renovacionconceptos.adecuacionrenovacion_id','=','adecuacionrenovacions.id')
        ->where('adecuacionrenovacions.productor_id','=',$user) 
        ->whereBetween('adecuacionrenovacions.fechaRegistro',['2021-08-01','2021-08-31'])
        ->sum('renovacionconceptos.valorTotal');
        $AgostoEstablecimiento = EstablecimientoConcepto::join('gastosestablecimientos','establecimientoconceptos.gastosEstablecimiento_id','=','gastosestablecimientos.id')
        ->where('gastosestablecimientos.productor_id','=',$user)  
        ->whereBetween('gastosestablecimientos.fechaRegistro',['2021-08-01','2021-08-31'])
        ->sum('establecimientoconceptos.valorTotal');
        $gastosAgosto = $AgostoProduccion +  $AgostoRenovacion + $AgostoEstablecimiento;
        $ventasAgosto = Venta:: whereBetween('ventas.fechaVenta',['2021-08-01','2021-08-31'])
        ->where('ventas.productor_id','=',$user)
        ->sum('ventas.totalVenta');
        $utilidadAgosto = $ventasAgosto - $gastosAgosto; 

        //Septiembre
        $SeptiembreProduccion = ProduccionConcepto::join('gastosproduccions','produccionconceptos.gastosProduccion_id','=','gastosproduccions.id')
        ->where('gastosproduccions.productor_id','=',$user)
        ->whereBetween('gastosproduccions.fechaRegistro',['2021-09-01','2021-09-30'])
        ->sum('produccionconceptos.valorTotal');
        $SeptiembreRenovacion = RenovacionConcepto::join('adecuacionrenovacions','renovacionconceptos.adecuacionrenovacion_id','=','adecuacionrenovacions.id')
        ->where('adecuacionrenovacions.productor_id','=',$user) 
        ->whereBetween('adecuacionrenovacions.fechaRegistro',['2021-09-01','2021-09-30'])
        ->sum('renovacionconceptos.valorTotal');
        $SeptiembreEstablecimiento = EstablecimientoConcepto::join('gastosestablecimientos','establecimientoconceptos.gastosEstablecimiento_id','=','gastosestablecimientos.id')
        ->where('gastosestablecimientos.productor_id','=',$user)  
        ->whereBetween('gastosestablecimientos.fechaRegistro',['2021-09-01','2021-09-30'])
        ->sum('establecimientoconceptos.valorTotal');
        $gastosSeptiembre = $SeptiembreProduccion +  $SeptiembreRenovacion + $SeptiembreEstablecimiento;
        $ventasSeptiembre = Venta:: whereBetween('ventas.fechaVenta',['2021-09-01','2021-09-30'])
        ->where('ventas.productor_id','=',$user)
        ->sum('ventas.totalVenta');
        $utilidadSeptiembre = $ventasSeptiembre - $gastosSeptiembre; 

        //Octubre
        $OctubreProduccion = ProduccionConcepto::join('gastosproduccions','produccionconceptos.gastosProduccion_id','=','gastosproduccions.id')
        ->where('gastosproduccions.productor_id','=',$user)
        ->whereBetween('gastosproduccions.fechaRegistro',['2021-10-01','2021-10-31'])
        ->sum('produccionconceptos.valorTotal');
        $OctubreRenovacion = RenovacionConcepto::join('adecuacionrenovacions','renovacionconceptos.adecuacionrenovacion_id','=','adecuacionrenovacions.id')
        ->where('adecuacionrenovacions.productor_id','=',$user) 
        ->whereBetween('adecuacionrenovacions.fechaRegistro',['2021-10-01','2021-10-31'])
        ->sum('renovacionconceptos.valorTotal');
        $OctubreEstablecimiento = EstablecimientoConcepto::join('gastosestablecimientos','establecimientoconceptos.gastosEstablecimiento_id','=','gastosestablecimientos.id')
        ->where('gastosestablecimientos.productor_id','=',$user)  
        ->whereBetween('gastosestablecimientos.fechaRegistro',['2021-10-01','2021-10-31'])
        ->sum('establecimientoconceptos.valorTotal');
        $gastosOctubre = $OctubreProduccion +  $OctubreRenovacion + $OctubreEstablecimiento;
        $ventasOctubre = Venta:: whereBetween('ventas.fechaVenta',['2021-10-01','2021-10-31'])
        ->where('ventas.productor_id','=',$user)
        ->sum('ventas.totalVenta');
        $utilidadOctubre = $ventasOctubre - $gastosOctubre; 

  
    
        //Noviembre
        $NoviembreProduccion = ProduccionConcepto::join('gastosproduccions','produccionconceptos.gastosProduccion_id','=','gastosproduccions.id')
        ->where('gastosproduccions.productor_id','=',$user)
        ->whereBetween('gastosproduccions.fechaRegistro',['2021-11-01','2021-11-30'])
        ->sum('produccionconceptos.valorTotal');
        $NoviembreRenovacion = RenovacionConcepto::join('adecuacionrenovacions','renovacionconceptos.adecuacionrenovacion_id','=','adecuacionrenovacions.id')
        ->where('adecuacionrenovacions.productor_id','=',$user) 
        ->whereBetween('adecuacionrenovacions.fechaRegistro',['2021-11-01','2021-11-30'])
        ->sum('renovacionconceptos.valorTotal');
        $NoviembreEstablecimiento = EstablecimientoConcepto::join('gastosestablecimientos','establecimientoconceptos.gastosEstablecimiento_id','=','gastosestablecimientos.id')
        ->where('gastosestablecimientos.productor_id','=',$user)  
        ->whereBetween('gastosestablecimientos.fechaRegistro',['2021-11-01','2021-11-30'])
        ->sum('establecimientoconceptos.valorTotal');
        $gastosNoviembre = $NoviembreProduccion +  $NoviembreRenovacion + $NoviembreEstablecimiento;
        $ventasNoviembre = Venta:: whereBetween('ventas.fechaVenta',['2021-11-01','2021-11-30'])
        ->where('ventas.productor_id','=',$user)
        ->sum('ventas.totalVenta');
        $utilidadNoviembre = $ventasNoviembre - $gastosNoviembre; 

        //Diciembre
        $DiciembreProduccion = ProduccionConcepto::join('gastosproduccions','produccionconceptos.gastosProduccion_id','=','gastosproduccions.id')
        ->where('gastosproduccions.productor_id','=',$user)
        ->whereBetween('gastosproduccions.fechaRegistro',['2021-12-01','2021-12-31'])
        ->sum('produccionconceptos.valorTotal');
        $DiciembreRenovacion = RenovacionConcepto::join('adecuacionrenovacions','renovacionconceptos.adecuacionrenovacion_id','=','adecuacionrenovacions.id')
        ->where('adecuacionrenovacions.productor_id','=',$user) 
        ->whereBetween('adecuacionrenovacions.fechaRegistro',['2021-12-01','2021-12-31'])
        ->sum('renovacionconceptos.valorTotal');
        $DiciembreEstablecimiento = EstablecimientoConcepto::join('gastosestablecimientos','establecimientoconceptos.gastosEstablecimiento_id','=','gastosestablecimientos.id')
        ->where('gastosestablecimientos.productor_id','=',$user)  
        ->whereBetween('gastosestablecimientos.fechaRegistro',['2021-12-01','2021-12-31'])
        ->sum('establecimientoconceptos.valorTotal');
        $gastosDiciembre = $DiciembreProduccion +  $DiciembreRenovacion + $DiciembreEstablecimiento;
        $ventasDiciembre = Venta:: whereBetween('ventas.fechaVenta',['2021-12-01','2021-12-31'])
        ->where('ventas.productor_id','=',$user)
        ->sum('ventas.totalVenta');
        $utilidadDiciembre = $ventasDiciembre - $gastosDiciembre; 

        $totalIngresos = $ventasEnero+$ventasFebrero+$ventasMarzo+$ventasAbril+$ventasMayo+$ventasJunio+$ventasJulio+$ventasAgosto+$ventasSeptiembre+$ventasOctubre+$ventasNoviembre+$ventasDiciembre;
        $totalGastos = $gastosEnero+$gastosFebrero+$gastosMarzo+$gastosAbril+$gastosMayo+$gastosJunio+$gastosJulio+$gastosAgosto+$gastosSeptiembre+$gastosOctubre+$gastosNoviembre+$gastosDiciembre;
        $utilidadTotal = $utilidadEnero+$utilidadFebrero+$utilidadMarzo+$utilidadAbril+$utilidadMayo+$utilidadJunio+$utilidadJulio+$utilidadAgosto+$utilidadSeptiembre+$utilidadOctubre+$utilidadNoviembre+$utilidadDiciembre;

       
        return [
        'GastosEnero' =>  $gastosEnero,
        'ventasEnero'=>$ventasEnero,
        'utilidadEnero'=>$utilidadEnero,

        'GastosFebrero' =>  $gastosFebrero,
        'ventasFebrero'=>$ventasFebrero,
        'utilidadFebrero'=>$utilidadFebrero,

        'GastosMarzo' =>  $gastosMarzo,
        'ventasMarzo'=>$ventasMarzo,
        'utilidadMarzo'=>$utilidadMarzo,

        'GastosAbril' =>  $gastosAbril,
        'ventasAbril'=>$ventasAbril,
        'utilidadAbril'=>$utilidadAbril,

        'GastosMayo' =>  $gastosMayo,
        'ventasMayo'=>$ventasMayo,
        'utilidadMayo'=>$utilidadMayo,

        'GastosJunio' =>  $gastosJunio,
        'ventasJunio'=>$ventasJunio,
        'utilidadJunio'=>$utilidadJunio,

        'GastosJulio' =>  $gastosJulio,
        'ventasJulio'=>$ventasJulio,
        'utilidadJulio'=>$utilidadJulio,

        'GastosAgosto' =>  $gastosAgosto,
        'ventasAgosto'=>$ventasAgosto,
        'utilidadAgosto'=>$utilidadAgosto,

        'GastosSeptiembre' =>  $gastosSeptiembre,
        'ventasSeptiembre'=>$ventasSeptiembre,
        'utilidadSeptiembre'=>$utilidadSeptiembre,

        'GastosOctubre' =>  $gastosOctubre,
        'ventasOctubre'=>$ventasOctubre,
        'utilidadOctubre'=>$utilidadOctubre,

        'GastosNoviembre' =>  $gastosNoviembre,
        'ventasNoviembre'=>$ventasNoviembre,
        'utilidadNoviembre'=>$utilidadNoviembre,

        'GastosDiciembre' =>  $gastosDiciembre,
        'ventasDiciembre'=>$ventasDiciembre,
        'utilidadDiciembre'=>$utilidadDiciembre,

        'ingresosTotal' =>  $totalIngresos,
        'gastosTotal'=>$totalGastos,
        'utilidadTotal'=>$utilidadTotal,
        ];
    }

    public function excel(){
        //Enero
        $EneroProduccion = ProduccionConcepto::join('gastosproduccions','produccionconceptos.gastosProduccion_id','=','gastosproduccions.id')
        ->whereBetween('gastosproduccions.fechaRegistro',['2021-01-01','2021-01-31'])
        ->sum('produccionconceptos.valorTotal');
        $EneroRenovacion = RenovacionConcepto::join('adecuacionrenovacions','renovacionconceptos.adecuacionrenovacion_id','=','adecuacionrenovacions.id')
        ->whereBetween('adecuacionrenovacions.fechaRegistro',['2021-01-01','2021-01-31'])
        ->sum('renovacionconceptos.valorTotal');
        $EneroEstablecimiento = EstablecimientoConcepto::join('gastosestablecimientos','establecimientoconceptos.gastosEstablecimiento_id','=','gastosestablecimientos.id')
        ->whereBetween('gastosestablecimientos.fechaRegistro',['2021-01-01','2021-01-31'])
        ->sum('establecimientoconceptos.valorTotal');
        $gastosEnero = $EneroProduccion +  $EneroRenovacion + $EneroEstablecimiento;
        $ventasEnero = Venta:: whereBetween('ventas.fechaVenta',['2021-01-01','2021-01-31'])
        ->sum('ventas.totalVenta');
        $utilidadEnero = $ventasEnero - $gastosEnero; 

        //Febrero
        $FebreroProduccion = ProduccionConcepto::join('gastosproduccions','produccionconceptos.gastosProduccion_id','=','gastosproduccions.id')
        ->whereBetween('gastosproduccions.fechaRegistro',['2021-02-01','2021-02-28'])
        ->sum('produccionconceptos.valorTotal');
        $FebreroRenovacion = RenovacionConcepto::join('adecuacionrenovacions','renovacionconceptos.adecuacionrenovacion_id','=','adecuacionrenovacions.id')
        ->whereBetween('adecuacionrenovacions.fechaRegistro',['2021-02-01','2021-02-28'])
        ->sum('renovacionconceptos.valorTotal');
        $FebreroEstablecimiento = EstablecimientoConcepto::join('gastosestablecimientos','establecimientoconceptos.gastosEstablecimiento_id','=','gastosestablecimientos.id')
        ->whereBetween('gastosestablecimientos.fechaRegistro',['2021-02-01','2021-02-28'])
        ->sum('establecimientoconceptos.valorTotal');
        $gastosFebrero = $FebreroProduccion +  $FebreroRenovacion + $FebreroEstablecimiento;
        $ventasFebrero = Venta:: whereBetween('ventas.fechaVenta',['2021-02-01','2021-02-28'])
        ->sum('ventas.totalVenta');
        $utilidadFebrero = $ventasFebrero - $gastosFebrero; 

       //Marzo
       $MarzoProduccion = ProduccionConcepto::join('gastosproduccions','produccionconceptos.gastosProduccion_id','=','gastosproduccions.id')
       ->whereBetween('gastosproduccions.fechaRegistro',['2021-03-01','2021-03-31'])
       ->sum('produccionconceptos.valorTotal');
       $MarzoRenovacion = RenovacionConcepto::join('adecuacionrenovacions','renovacionconceptos.adecuacionrenovacion_id','=','adecuacionrenovacions.id')
       ->whereBetween('adecuacionrenovacions.fechaRegistro',['2021-03-01','2021-03-31'])
       ->sum('renovacionconceptos.valorTotal');
       $MarzoEstablecimiento = EstablecimientoConcepto::join('gastosestablecimientos','establecimientoconceptos.gastosEstablecimiento_id','=','gastosestablecimientos.id')
       ->whereBetween('gastosestablecimientos.fechaRegistro',['2021-03-01','2021-03-31'])
       ->sum('establecimientoconceptos.valorTotal');
       $gastosMarzo = $MarzoProduccion +  $MarzoRenovacion + $MarzoEstablecimiento;
       $ventasMarzo = Venta:: whereBetween('ventas.fechaVenta',['2021-03-01','2021-03-31'])
       ->sum('ventas.totalVenta');
       $utilidadMarzo = $ventasMarzo - $gastosMarzo; 


       //Abril
       $AbrilProduccion = ProduccionConcepto::join('gastosproduccions','produccionconceptos.gastosProduccion_id','=','gastosproduccions.id')
       ->whereBetween('gastosproduccions.fechaRegistro',['2021-04-01','2021-04-30'])
       ->sum('produccionconceptos.valorTotal');
       $AbrilRenovacion = RenovacionConcepto::join('adecuacionrenovacions','renovacionconceptos.adecuacionrenovacion_id','=','adecuacionrenovacions.id')
       ->whereBetween('adecuacionrenovacions.fechaRegistro',['2021-04-01','2021-04-30'])
       ->sum('renovacionconceptos.valorTotal');
       $AbrilEstablecimiento = EstablecimientoConcepto::join('gastosestablecimientos','establecimientoconceptos.gastosEstablecimiento_id','=','gastosestablecimientos.id')
       ->whereBetween('gastosestablecimientos.fechaRegistro',['2021-04-01','2021-04-30'])
       ->sum('establecimientoconceptos.valorTotal');
       $gastosAbril = $AbrilProduccion +  $AbrilRenovacion + $AbrilEstablecimiento;
       $ventasAbril = Venta:: whereBetween('ventas.fechaVenta',['2021-04-01','2021-04-30'])
       ->sum('ventas.totalVenta');
       $utilidadAbril = $ventasAbril - $gastosAbril; 

       //Mayo
       $MayoProduccion = ProduccionConcepto::join('gastosproduccions','produccionconceptos.gastosProduccion_id','=','gastosproduccions.id')
       ->whereBetween('gastosproduccions.fechaRegistro',['2021-05-01','2021-05-31'])
       ->sum('produccionconceptos.valorTotal');
       $MayoRenovacion = RenovacionConcepto::join('adecuacionrenovacions','renovacionconceptos.adecuacionrenovacion_id','=','adecuacionrenovacions.id')
       ->whereBetween('adecuacionrenovacions.fechaRegistro',['2021-05-01','2021-05-31'])
       ->sum('renovacionconceptos.valorTotal');
       $MayoEstablecimiento = EstablecimientoConcepto::join('gastosestablecimientos','establecimientoconceptos.gastosEstablecimiento_id','=','gastosestablecimientos.id')
       ->whereBetween('gastosestablecimientos.fechaRegistro',['2021-05-01','2021-05-31'])
       ->sum('establecimientoconceptos.valorTotal');
       $gastosMayo = $MayoProduccion +  $MayoRenovacion + $MayoEstablecimiento;
       $ventasMayo = Venta:: whereBetween('ventas.fechaVenta',['2021-05-01','2021-05-31'])
       ->sum('ventas.totalVenta');
       $utilidadMayo = $ventasMayo - $gastosMayo; 

       //Junio
       $JunioProduccion = ProduccionConcepto::join('gastosproduccions','produccionconceptos.gastosProduccion_id','=','gastosproduccions.id')
       ->whereBetween('gastosproduccions.fechaRegistro',['2021-06-01','2021-06-30'])
       ->sum('produccionconceptos.valorTotal');
       $JunioRenovacion = RenovacionConcepto::join('adecuacionrenovacions','renovacionconceptos.adecuacionrenovacion_id','=','adecuacionrenovacions.id')
       ->whereBetween('adecuacionrenovacions.fechaRegistro',['2021-06-01','2021-06-30'])
       ->sum('renovacionconceptos.valorTotal');
       $JunioEstablecimiento = EstablecimientoConcepto::join('gastosestablecimientos','establecimientoconceptos.gastosEstablecimiento_id','=','gastosestablecimientos.id')
       ->whereBetween('gastosestablecimientos.fechaRegistro',['2021-06-01','2021-06-30'])
       ->sum('establecimientoconceptos.valorTotal');
       $gastosJunio = $JunioProduccion +  $JunioRenovacion + $JunioEstablecimiento;
       $ventasJunio = Venta:: whereBetween('ventas.fechaVenta',['2021-06-01','2021-06-30'])
       ->sum('ventas.totalVenta');
       $utilidadJunio = $ventasJunio - $gastosJunio; 

       //Julio
       $JulioProduccion = ProduccionConcepto::join('gastosproduccions','produccionconceptos.gastosProduccion_id','=','gastosproduccions.id')
       ->whereBetween('gastosproduccions.fechaRegistro',['2021-07-01','2021-07-31'])
       ->sum('produccionconceptos.valorTotal');
       $JulioRenovacion = RenovacionConcepto::join('adecuacionrenovacions','renovacionconceptos.adecuacionrenovacion_id','=','adecuacionrenovacions.id')
       ->whereBetween('adecuacionrenovacions.fechaRegistro',['2021-07-01','2021-07-31'])
       ->sum('renovacionconceptos.valorTotal');
       $JulioEstablecimiento = EstablecimientoConcepto::join('gastosestablecimientos','establecimientoconceptos.gastosEstablecimiento_id','=','gastosestablecimientos.id')
       ->whereBetween('gastosestablecimientos.fechaRegistro',['2021-07-01','2021-07-31'])
       ->sum('establecimientoconceptos.valorTotal');
       $gastosJulio = $JulioProduccion +  $JulioRenovacion + $JulioEstablecimiento;
       $ventasJulio = Venta:: whereBetween('ventas.fechaVenta',['2021-07-01','2021-07-31'])
       ->sum('ventas.totalVenta');
       $utilidadJulio = $ventasJulio - $gastosJulio; 

       //Agosto
       $AgostoProduccion = ProduccionConcepto::join('gastosproduccions','produccionconceptos.gastosProduccion_id','=','gastosproduccions.id')
       ->whereBetween('gastosproduccions.fechaRegistro',['2021-08-01','2021-08-31'])
       ->sum('produccionconceptos.valorTotal');
       $AgostoRenovacion = RenovacionConcepto::join('adecuacionrenovacions','renovacionconceptos.adecuacionrenovacion_id','=','adecuacionrenovacions.id')
       ->whereBetween('adecuacionrenovacions.fechaRegistro',['2021-08-01','2021-08-31'])
       ->sum('renovacionconceptos.valorTotal');
       $AgostoEstablecimiento = EstablecimientoConcepto::join('gastosestablecimientos','establecimientoconceptos.gastosEstablecimiento_id','=','gastosestablecimientos.id')
       ->whereBetween('gastosestablecimientos.fechaRegistro',['2021-08-01','2021-08-31'])
       ->sum('establecimientoconceptos.valorTotal');
       $gastosAgosto = $AgostoProduccion +  $AgostoRenovacion + $AgostoEstablecimiento;
       $ventasAgosto = Venta:: whereBetween('ventas.fechaVenta',['2021-08-01','2021-08-31'])
       ->sum('ventas.totalVenta');
       $utilidadAgosto = $ventasAgosto - $gastosAgosto; 

        //Septiembre
        $SeptiembreProduccion = ProduccionConcepto::join('gastosproduccions','produccionconceptos.gastosProduccion_id','=','gastosproduccions.id')
        ->whereBetween('gastosproduccions.fechaRegistro',['2021-09-01','2021-09-30'])
        ->sum('produccionconceptos.valorTotal');
        $SeptiembreRenovacion = RenovacionConcepto::join('adecuacionrenovacions','renovacionconceptos.adecuacionrenovacion_id','=','adecuacionrenovacions.id')
        ->whereBetween('adecuacionrenovacions.fechaRegistro',['2021-09-01','2021-09-30'])
        ->sum('renovacionconceptos.valorTotal');
        $SeptiembreEstablecimiento = EstablecimientoConcepto::join('gastosestablecimientos','establecimientoconceptos.gastosEstablecimiento_id','=','gastosestablecimientos.id')
        ->whereBetween('gastosestablecimientos.fechaRegistro',['2021-09-01','2021-09-30'])
        ->sum('establecimientoconceptos.valorTotal');
        $gastosSeptiembre = $SeptiembreProduccion +  $SeptiembreRenovacion + $SeptiembreEstablecimiento;
        $ventasSeptiembre = Venta:: whereBetween('ventas.fechaVenta',['2021-09-01','2021-09-30'])
        ->sum('ventas.totalVenta');
        $utilidadSeptiembre = $ventasSeptiembre - $gastosSeptiembre; 

       //Octubre
       $OctubreProduccion = ProduccionConcepto::join('gastosproduccions','produccionconceptos.gastosProduccion_id','=','gastosproduccions.id')
       ->whereBetween('gastosproduccions.fechaRegistro',['2021-10-01','2021-10-31'])
       ->sum('produccionconceptos.valorTotal');
       $OctubreRenovacion = RenovacionConcepto::join('adecuacionrenovacions','renovacionconceptos.adecuacionrenovacion_id','=','adecuacionrenovacions.id')
       ->whereBetween('adecuacionrenovacions.fechaRegistro',['2021-10-01','2021-10-31'])
       ->sum('renovacionconceptos.valorTotal');
       $OctubreEstablecimiento = EstablecimientoConcepto::join('gastosestablecimientos','establecimientoconceptos.gastosEstablecimiento_id','=','gastosestablecimientos.id')
       ->whereBetween('gastosestablecimientos.fechaRegistro',['2021-10-01','2021-10-31'])
       ->sum('establecimientoconceptos.valorTotal');
       $gastosOctubre = $OctubreProduccion +  $OctubreRenovacion + $OctubreEstablecimiento;
       $ventasOctubre = Venta:: whereBetween('ventas.fechaVenta',['2021-10-01','2021-10-31'])
       ->sum('ventas.totalVenta');
       $utilidadOctubre = $ventasOctubre - $gastosOctubre; 

 
   
       //Noviembre
       $NoviembreProduccion = ProduccionConcepto::join('gastosproduccions','produccionconceptos.gastosProduccion_id','=','gastosproduccions.id')
       ->whereBetween('gastosproduccions.fechaRegistro',['2021-11-01','2021-11-30'])
       ->sum('produccionconceptos.valorTotal');
       $NoviembreRenovacion = RenovacionConcepto::join('adecuacionrenovacions','renovacionconceptos.adecuacionrenovacion_id','=','adecuacionrenovacions.id')
       ->whereBetween('adecuacionrenovacions.fechaRegistro',['2021-11-01','2021-11-30'])
       ->sum('renovacionconceptos.valorTotal');
       $NoviembreEstablecimiento = EstablecimientoConcepto::join('gastosestablecimientos','establecimientoconceptos.gastosEstablecimiento_id','=','gastosestablecimientos.id')
       ->whereBetween('gastosestablecimientos.fechaRegistro',['2021-11-01','2021-11-30'])
       ->sum('establecimientoconceptos.valorTotal');
       $gastosNoviembre = $NoviembreProduccion +  $NoviembreRenovacion + $NoviembreEstablecimiento;
       $ventasNoviembre = Venta:: whereBetween('ventas.fechaVenta',['2021-11-01','2021-11-30'])
       ->sum('ventas.totalVenta');
       $utilidadNoviembre = $ventasNoviembre - $gastosNoviembre; 

       //Diciembre
       $DiciembreProduccion = ProduccionConcepto::join('gastosproduccions','produccionconceptos.gastosProduccion_id','=','gastosproduccions.id')
       ->whereBetween('gastosproduccions.fechaRegistro',['2021-12-01','2021-12-31'])
       ->sum('produccionconceptos.valorTotal');
       $DiciembreRenovacion = RenovacionConcepto::join('adecuacionrenovacions','renovacionconceptos.adecuacionrenovacion_id','=','adecuacionrenovacions.id')
       ->whereBetween('adecuacionrenovacions.fechaRegistro',['2021-12-01','2021-12-31'])
       ->sum('renovacionconceptos.valorTotal');
       $DiciembreEstablecimiento = EstablecimientoConcepto::join('gastosestablecimientos','establecimientoconceptos.gastosEstablecimiento_id','=','gastosestablecimientos.id')
       ->whereBetween('gastosestablecimientos.fechaRegistro',['2021-12-01','2021-12-31'])
       ->sum('establecimientoconceptos.valorTotal');
       $gastosDiciembre = $DiciembreProduccion +  $DiciembreRenovacion + $DiciembreEstablecimiento;
       $ventasDiciembre = Venta:: whereBetween('ventas.fechaVenta',['2021-12-01','2021-12-31'])
       ->sum('ventas.totalVenta');
       $utilidadDiciembre = $ventasDiciembre - $gastosDiciembre; 

       $totalIngresos = $ventasEnero+$ventasFebrero+$ventasMarzo+$ventasAbril+$ventasMayo+$ventasJunio+$ventasJulio+$ventasAgosto+$ventasSeptiembre+$ventasOctubre+$ventasNoviembre+$ventasDiciembre;
       $totalGastos = $gastosEnero+$gastosFebrero+$gastosMarzo+$gastosAbril+$gastosMayo+$gastosJunio+$gastosJulio+$gastosAgosto+$gastosSeptiembre+$gastosOctubre+$gastosNoviembre+$gastosDiciembre;
       $utilidadTotal = $utilidadEnero+$utilidadFebrero+$utilidadMarzo+$utilidadAbril+$utilidadMayo+$utilidadJunio+$utilidadJulio+$utilidadAgosto+$utilidadSeptiembre+$utilidadOctubre+$utilidadNoviembre+$utilidadDiciembre;
      
        return [
            
            'GastosEnero' =>  $gastosEnero,
            'ventasEnero'=>$ventasEnero,
            'utilidadEnero'=>$utilidadEnero,

            'GastosFebrero' =>  $gastosFebrero,
            'ventasFebrero'=>$ventasFebrero,
            'utilidadFebrero'=>$utilidadFebrero,

            'GastosMarzo' =>  $gastosMarzo,
            'ventasMarzo'=>$ventasMarzo,
            'utilidadMarzo'=>$utilidadMarzo,

            'GastosAbril' =>  $gastosAbril,
            'ventasAbril'=>$ventasAbril,
            'utilidadAbril'=>$utilidadAbril,

            'GastosMayo' =>  $gastosMayo,
            'ventasMayo'=>$ventasMayo,
            'utilidadMayo'=>$utilidadMayo,

            'GastosJunio' =>  $gastosJunio,
            'ventasJunio'=>$ventasJunio,
            'utilidadJunio'=>$utilidadJunio,

            'GastosJulio' =>  $gastosJulio,
            'ventasJulio'=>$ventasJulio,
            'utilidadJulio'=>$utilidadJulio,

            'GastosAgosto' =>  $gastosAgosto,
            'ventasAgosto'=>$ventasAgosto,
            'utilidadAgosto'=>$utilidadAgosto,

            'GastosSeptiembre' =>  $gastosSeptiembre,
            'ventasSeptiembre'=>$ventasSeptiembre,
            'utilidadSeptiembre'=>$utilidadSeptiembre,

            'GastosOctubre' =>  $gastosOctubre,
            'ventasOctubre'=>$ventasOctubre,
            'utilidadOctubre'=>$utilidadOctubre,

            'GastosNoviembre' =>  $gastosNoviembre,
            'ventasNoviembre'=>$ventasNoviembre,
            'utilidadNoviembre'=>$utilidadNoviembre,

            'GastosDiciembre' =>  $gastosDiciembre,
            'ventasDiciembre'=>$ventasDiciembre,
            'utilidadDiciembre'=>$utilidadDiciembre,

            'ingresosTotal' =>  $totalIngresos,
            'gastosTotal'=>$totalGastos,
            'utilidadTotal'=>$utilidadTotal,
        ];       
    }
}
