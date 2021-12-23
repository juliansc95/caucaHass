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
        ->select(DB::raw('DATE(v.fechaVenta) as mes'),
        DB::raw('DAY(v.fechaVenta) as anio'),
        DB::raw('SUM(v.totalVenta) as total'))
        ->whereYear('v.fechaVenta',$anio)
        ->groupBy(DB::raw('DATE(v.fechaVenta)'),DB::raw('DAY(v.fechaVenta)'))
        ->get(); 

        $usuarios=DB::table('personas as v')
        ->select(DB::raw('DATE(v.created_at) as mes'),
        DB::raw('DAY(v.created_at) as anio'),
        DB::raw('COUNT(v.id) as total'))
        ->groupBy(DB::raw('DATE(v.created_at)'),DB::raw('DAY(v.created_at)'))
        ->get();

        return ['ventas'=>$ventas,'anio'=>$anio,'usuarios'=>$usuarios];         

    }
}
