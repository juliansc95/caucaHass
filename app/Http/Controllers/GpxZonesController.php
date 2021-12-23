<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\GpxZones;


class GpxZonesController extends Controller
{
    public function formSubmit(Request $request)
    {
        $name = $request->name;
        $fileName = time().$name.'.'.$request->file->getClientOriginalExtension();
        $request->file->move(public_path('upload'), $fileName);
        $slash='/';
       $feed = file_get_contents('/home/asofruto/Developer/asofrutf/public/upload'.$slash.$fileName);
       //$feed = file_get_contents('C:\xampp\htdocs\asofrut\public\upload'.$slash.$fileName);
       $gpx = simplexml_load_string($feed);
       
       $linea ="[";
       foreach ($gpx->trk as $trk) {
        foreach($trk->trkseg as $seg){
            foreach($seg->trkpt as $pt){
                $linea .= "{".'"lat"'.":".$pt["lat"].",".'"lng"'.":".$pt["lon"]."},";
            }}}
        unset($gpx);
        $linea = substr($linea,0,-1);
        $linea .= "]";
        
        $gpx = new GpxZones();
        $gpx->productor_id = $request->productor_id;
        $gpx->finca_id = $request->finca_id;
        $gpx->linea =  $linea;
        $gpx->save(); 

        return response()->json(['success'=>'La carga de su archivo ha sido exitosa.']);
    }

    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

            $gps= GpxZones::join('productors','gpxzones.productor_id','=','productors.id')
            ->join('personas','gpxzones.productor_id','=','personas.id')
            ->join('fincas','gpxzones.finca_id','=','fincas.id')
            ->select('gpxzones.id','gpxzones.productor_id','gpxzones.finca_id',
           'personas.nombre as nombre_persona','fincas.nombre as nombre_finca','gpxzones.linea')
            ->orderBy('gpxzones.id', 'desc')->get();          
            return [
            'gps' => $gps
        ];
    }
}

