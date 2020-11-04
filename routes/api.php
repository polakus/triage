<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\Facades\DataTables;

// use DB;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('profesionales',function(Request $request){
	// return datatables()->query(DB::table('detalle_atencion as da')
 //                                 ->join('det_profesionales_salas as det_prof_salas','det_prof_salas.id','=','da.id_det_profesional_sala')
 //                                 ->join('profesionales as prof','prof.id','=','det_prof_salas.id_profesional')
 //                                 ->join('Atencion as a','a.id','=','da.id_atencion')
 //                                 ->join('Pacientes as p','p.Paciente_id','=','a.Paciente_id')
 //                                 ->select('p.nombre as paciente_nombre','p.apellido as paciente_apellido','prof.nombre','prof.apellido','prof.matricula','da.fecha','da.hora'))->toJson();
	$detalles_atenciones="";
	if($request->get('desde')=="" or $request->get('hasta')==""){		
	$detalles_atenciones=DB::table('detalle_atencion as da')
                                 ->join('det_profesionales_salas as det_prof_salas','det_prof_salas.id','=','da.id_det_profesional_sala')
                                 ->join('profesionales as prof','prof.id','=','det_prof_salas.id_profesional')
                                 ->join('Atencion as a','a.id','=','da.id_atencion')
                                 ->join('Pacientes as p','p.Paciente_id','=','a.Paciente_id')
                                 ->select(DB::raw("CONCAT(prof.apellido,' ',prof.nombre) as full_name"),
                                 	DB::raw("CONCAT(p.apellido,' ',p.nombre) as full_name_paciente"),'prof.matricula','da.fecha','da.hora')->get();
    }
    else{

    	$detalles_atenciones=DB::table('detalle_atencion as da')
                                 ->join('det_profesionales_salas as det_prof_salas','det_prof_salas.id','=','da.id_det_profesional_sala')
                                 ->join('profesionales as prof','prof.id','=','det_prof_salas.id_profesional')
                                 ->join('Atencion as a','a.id','=','da.id_atencion')
                                 ->join('Pacientes as p','p.Paciente_id','=','a.Paciente_id')
                                 ->select(DB::raw("CONCAT(prof.apellido,' ',prof.nombre) as full_name"),
                                 	DB::raw("CONCAT(p.apellido,' ',p.nombre) as full_name_paciente"),'prof.matricula','da.fecha','da.hora')
                                 ->whereBetween('da.fecha',[$request->get('desde'),$request->get('hasta')])
                                 ->get();

    }
	return DataTables::of($detalles_atenciones)->toJson();
});

Route::get('ApiPacientes',function(){
    $pacientes= DB::table('Pacientes')->where('nombre','!=','nn')->where('apellido','!=','nn')->get();

    return DataTables::of($pacientes)
                       ->addColumn('btn','pacientes/botones')
                       ->rawColumns(['Accion','btn']) 
    ->toJson();
});


Route::get('mostrar',function(){
    $pacientes= DB::table('detalle_atencion as da')
                    ->join('det_especialidad_area as det_e_a','det_e_a.id_especialidad','=','da.id_especialidad')
                    ->join('Areas as are','are.id','=','det_e_a.id_area')
                    ->join('Especialidades as esp','esp.id','=','det_e_a.id_especialidad')
                    ->join('Atencion as a','a.id','=','da.id_atencion')
                    ->join('Pacientes as p','p.Paciente_id','=','a.Paciente_id')
                    ->join('CodigosTriage as codigotriage','codigotriage.id','=','da.id_codigo_triage')
                   
                    ->select(DB::raw("CONCAT(p.apellido,' ',p.nombre) as paciente_full"),
                        DB::raw("CONCAT(da.fecha,' ',da.hora) as fecha_hora"),
                        'are.tipo_dato','esp.nombre as especialidad','da.estado','da.id_codigo_triage','da.id','da.sala','codigotriage.color','da.operar')
                    // ->where('da.fecha','=',date('Y-m-d'))
                    
                    ->orderBy('da.id_codigo_triage','DESC')
                    ->orderBy('da.hora','ASC')
                    ->get();
   
    
    return DataTables::of($pacientes)
                        ->addColumn('observacion',function($paciente){
                            $encontrar=DB::table('historial as h')
                            ->join('cie as c','c.id','=','h.id_cie')
                            ->where('h.id_detalle_atencion','=',$paciente->id)
                            ->select('h.descripcion as observacion','c.codigo','c.descripcion','h.id_detalle_atencion')
                            ->first();
                            if($encontrar!=null){
                                return '<td>CIE:'.$encontrar->codigo.'-'.$encontrar->descripcion.'<br>'.$encontrar->observacion.'</td>';
                            }else{
                                return '<td> </td>';
                            }
                        })
                        // ->rawColumns(['observacion'])
                        ->addColumn('Internacion','turnos/actionsInternar')
                        // ->addColumn('Operar','turnos/actionsOperar')
                        ->addColumn('Operar', function($pacientes){
                            $salas = DB::table('salas as s')
                                        ->join('Areas as a','a.id','=','s.id_area')
                                        ->select('a.tipo_dato','s.nombre','s.camas','s.disponibilidad','s.id')
                                        ->get();
                            return view('turnos/actionsOperar', compact('pacientes', 'salas'));
                        })  
                        ->addColumn('DarAlta','turnos/daralta')  
                        ->rawColumns(['observacion','Internacion','Operar','DarAlta'])
                    ->toJson();
});


Route::get('sintomas_cargar', function(){
     $sintomas=DB::table('sintomas')->get();
     return DataTables::of($sintomas)
                       ->addColumn('button','sintomas/action_eliminar')
                       ->rawColumns(['button']) 
    ->toJson();
});

Route::get('cargar_cie', function(){
    // $cies = App\CIE::all();
    $enfermedades = DB::table('cie')->get();
    return DataTables::of($enfermedades)
                        ->addColumn('button', 'cie/action_editar')
                        ->rawColumns(['button']) 
                        ->toJson();
});

Route::get('dtespecialidades', function(){
    // $especialidades = App\Especialidad::all();
    $especialidades = DB::table('Especialidades as esp')
                        ->join('det_especialidad_area as det','det.id_especialidad','=','esp.id')
                        ->join('Areas as a','a.id','=','det.id_area')
                        ->select('esp.id','esp.nombre','esp.descripcion', 'a.tipo_dato', 'a.id as id_area')
                        ->get();
    $editareas = App\Area::all();
    // $area_seleccionada = App\Det_especialidad_area::where('id_especialidad', '=', $especialidades->id)->first()->area->id;
    return DataTables::of($especialidades)
                        // ->addColumn('area', function($especialidades){
                        //     $unavariable = '';
                        //     foreach($especialidades->Det_especialidad_area as $det){
                        //         $unavariable = $det->area->tipo_dato;
                        //     }
                        //     return $unavariable;
                        // })
                        ->addColumn('button', function($especialidad) use ($editareas){
                            return view('especialidades/accion_editar', compact('editareas', 'especialidad'));
                        })
                        ->rawColumns(['button']) 
                        ->toJson();
});
Route::get('historial',function(Request $request){
    $historial=DB::table('historial as h')
                     ->join('detalle_atencion as dt','dt.id','=','h.id_detalle_atencion')
                     ->join('Atencion as a','a.id','=','dt.id_atencion')
                     
                     ->join('cie as c','c.id','=','h.id_cie')
                     ->select('c.descripcion','c.codigo','h.descripcion as observacion')
                     ->where('a.Paciente_id','=',$request->id_paciente)
                    
                    ->get();
    return DataTables::of($historial)
           ->toJson();
});

