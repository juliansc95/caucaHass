<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\GpxUpload;


class GpxUploadController extends Controller
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
        
        foreach ($gpx->wpt as $pt) {
            $lat = (string) $pt['lat'];
            $lon = (string) $pt['lon'];
            $ele = (string) $pt->ele;
            $name = (string) $pt->name;
        }
        unset($gpx);   
        
        $latitud = $lat;
        $longitud=$lon;
        $gpx = new GpxUpload();
        $gpx->productor_id = $request->productor_id;
        $gpx->finca_id = $request->finca_id;
        $gpx->latitud =  $latitud;
        $gpx->longitud =  $longitud;
        $gpx->save(); 

        return response()->json(['success'=>'La carga de su archivo ha sido exitosa.']);
    }

    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

            $gps= GpxUpload::join('productors','gpxs.productor_id','=','productors.id')
            ->join('personas','gpxs.productor_id','=','personas.id')
            ->join('fincas','gpxs.finca_id','=','fincas.id')
            ->select('gpxs.id','gpxs.productor_id','gpxs.finca_id','gpxs.latitud',
            'gpxs.longitud','personas.nombre as nombre_persona','fincas.nombre as nombre_finca')
            ->orderBy('gpxs.id', 'desc')->paginate(100);          
            return [
                'pagination' => [
                    'total'        => $gps->total(),
                    'current_page' => $gps->currentPage(),
                    'per_page'     => $gps->perPage(),
                    'last_page'    => $gps->lastPage(),
                    'from'         => $gps->firstItem(),
                    'to'           => $gps->lastItem(),
                ],
            'gps' => $gps
        ];
    }
}
