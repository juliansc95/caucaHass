<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $anio=date('Y');
       
        $ventas=DB::table('ventas as v')
        ->select(
        DB::raw('date_add(date("1900-01-01"), interval v.Fecha day ) as Fechaa '),    
        DB::raw('DAY(date_add(date("1900-01-01"), interval Fecha day)) as anio'),
        DB::raw('SUM(v.TotalItem) as total'))
        //->whereYear('Fecha',$anio)
       ->groupBy(DB::raw('Fechaa'))
        ->get(); 

        $compras=DB::table('compras as c')
        ->select(
        DB::raw('date_add(date("1900-01-01"), interval c.Fecha day ) as Fechaa '),    
        DB::raw('DAY(date_add(date("1900-01-01"), interval Fecha day)) as anio'),
        DB::raw('SUM(c.TotalItem) as total'))
        //->whereYear('Fecha',$anio)
       ->groupBy(DB::raw('Fechaa'))
        ->get(); 

        $usuarios=DB::table('personas as p')
        ->select(DB::raw('DATE(p.created_at) as mes'),
        DB::raw('DAY(p.created_at) as anio'),
        DB::raw('COUNT(p.id) as total'))
        ->groupBy(DB::raw('DATE(p.created_at)'),DB::raw('DAY(p.created_at)'))
        ->get();

        $proyeccions=DB::table('proyeccions as proyeccions')
        ->select(
        DB::raw('(SELECT SUM(kgProyectadoLoteUno)+SUM(kgProyectadoLoteDos) FROM proyeccions WHERE periodo="2021-1" and tipo="Nacional") as Nacional'),    
        DB::raw('(SELECT SUM(kgProyectadoLoteUno)+SUM(kgProyectadoLoteDos) FROM proyeccions WHERE periodo="2021-1" and tipo="Exportacion") as Exportacion')   
        //->whereYear('Fecha',$anio)
       )->take(1)->get(); 

       $proyeccions20212=DB::table('proyeccions as proyeccions')
        ->select(
        DB::raw('(SELECT SUM(kgProyectadoLoteUno)+SUM(kgProyectadoLoteDos) FROM proyeccions WHERE periodo="2021-2" and tipo="Nacional") as Nacional'),    
        DB::raw('(SELECT SUM(kgProyectadoLoteUno)+SUM(kgProyectadoLoteDos) FROM proyeccions WHERE periodo="2021-2" and tipo="Exportacion") as Exportacion')   
        //->whereYear('Fecha',$anio)
       )->take(1)->get(); 

        return ['ventas'=>$ventas,'anio'=>$anio,'usuarios'=>$usuarios,'compras'=>$compras,
        'proyeccions'=>$proyeccions,'proyeccions20212'=>$proyeccions20212
        ];         

    }
}
