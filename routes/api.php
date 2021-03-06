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
                                 ->join('atencion as a','a.id','=','da.id_atencion')
                                 ->join('pacientes as p','p.Paciente_id','=','a.Paciente_id')
                                 ->select(DB::raw("CONCAT(prof.apellido,' ',prof.nombre) as full_name"),
                                 	DB::raw("CONCAT(p.apellido,' ',p.nombre) as full_name_paciente"),'prof.matricula','da.fecha','da.hora')->get();
    }
    else{

    	$detalles_atenciones=DB::table('detalle_atencion as da')
                                 ->join('det_profesionales_salas as det_prof_salas','det_prof_salas.id','=','da.id_det_profesional_sala')
                                 ->join('profesionales as prof','prof.id','=','det_prof_salas.id_profesional')
                                 ->join('atencion as a','a.id','=','da.id_atencion')
                                 ->join('pacientes as p','p.Paciente_id','=','a.Paciente_id')
                                 ->select(DB::raw("CONCAT(prof.apellido,' ',prof.nombre) as full_name"),
                                 	DB::raw("CONCAT(p.apellido,' ',p.nombre) as full_name_paciente"),'prof.matricula','da.fecha','da.hora')
                                 ->whereBetween('da.fecha',[$request->get('desde'),$request->get('hasta')])
                                 ->get();

    }
	return DataTables::of($detalles_atenciones)->toJson();
});

Route::get('ApiPacientes',function(){
    $pacientes= DB::table('pacientes')->where('nombre','!=','nn')->where('apellido','!=','nn')->get();

    return DataTables::of($pacientes)
                       ->addColumn('btn','pacientes/botones')
                       ->rawColumns(['Accion','btn'])
    ->toJson();
});


Route::get('mostrar',function(){
    $pacientes= DB::table('detalle_atencion as da')
                    ->join('det_especialidad_area as det_e_a','det_e_a.id_especialidad','=','da.id_especialidad')
                    ->join('areas as are','are.id','=','det_e_a.id_area')
                    ->join('especialidades as esp','esp.id','=','det_e_a.id_especialidad')
                    ->join('atencion as a','a.id','=','da.id_atencion')
                    ->join('pacientes as p','p.Paciente_id','=','a.Paciente_id')
                    ->join('codigostriage as codigotriage','codigotriage.id','=','da.id_codigo_triage')

                    ->select(DB::raw("CONCAT(p.apellido,' ',p.nombre) as paciente_full"),
                        DB::raw("CONCAT(da.fecha,' ',da.hora) as fecha_hora"),
                        'are.nombre','esp.nombre as especialidad','da.estado','da.id_codigo_triage','da.id','da.sala','codigotriage.color','da.operar')
                    // ->where('da.fecha','=',date('Y-m-d'))

                    ->orderBy('da.id_codigo_triage','DESC')
                    ->orderBy('da.fecha','DESC')
                    ->orderBy('da.hora','ASC')
                    ->get();

    $salas = DB::table('salas as s')
                    ->join('areas as a','a.id','=','s.id_area')
                    ->select('a.nombre','s.nombre','s.camas','s.disponibilidad','s.id')
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
                        ->addColumn('Internacion', function($paciente) use($salas){
                            return view('turnos/actionsInternar',compact('paciente','salas'));
                        })
                        // ->addColumn('Operar','turnos/actionsOperar')
                        ->addColumn('Operar', function($paciente) use ($salas){

                            return view('turnos/actionsOperar', compact('paciente', 'salas'));
                        })
                        ->addColumn('DarAlta','turnos/daralta')
                        ->rawColumns(['observacion','Internacion','Operar','DarAlta'])
                    ->toJson();
});


Route::get('sintomas_cargar', function(){
     $sintomas=DB::table('sintomas')->get();
     return DataTables::of($sintomas)
                       ->addColumn('button','sintomas/action_editar_eliminar')
                       ->rawColumns(['button'])
    ->toJson();
});

Route::get('cargar_cie', function(){
    // $cies = App\CIE::all();
    $enfermedades = DB::table('cie')->orderBy('codigo')->get();
    return DataTables::of($enfermedades)
                        ->addColumn('button', 'cie/action_editar')
                        ->rawColumns(['button'])
                        ->toJson();
});

Route::get('dtespecialidades', function(){
    // $especialidades = App\Especialidad::all();
    $especialidades = DB::table('especialidades as esp')
                        ->join('det_especialidad_area as det','det.id_especialidad','=','esp.id')
                        ->join('areas as a','a.id','=','det.id_area')
                        ->select('esp.id','esp.nombre as nombesp','esp.descripcion', 'a.nombre as nombarea', 'a.id as id_area')
                        ->get();
    $editareas = App\Area::all();
    // $area_seleccionada = App\Det_especialidad_area::where('id_especialidad', '=', $especialidades->id)->first()->area->id;
    return DataTables::of($especialidades)
                        ->addColumn('button', function($especialidad) use ($editareas){
                            return view('especialidades/accion_editar', compact('editareas', 'especialidad'));
                        })
                        ->rawColumns(['button'])
                        ->toJson();
});
Route::get('historial',function(Request $request){
    $historial=DB::table('historial as h')
                     ->join('detalle_atencion as dt','dt.id','=','h.id_detalle_atencion')
                     ->join('atencion as a','a.id','=','dt.id_atencion')

                     ->join('cie as c','c.id','=','h.id_cie')
                     ->select('c.descripcion','c.codigo','h.descripcion as observacion')
                     ->where('a.Paciente_id','=',$request->id_paciente)

                    ->get();
    return DataTables::of($historial)
           ->toJson();
});

Route::get('protocolos',function(){
    $protocolos=App\Protocolo::select('*')
                    ->join('det_protocolos as det','protocolos.id','=','det.id_protocolo')
                    ->whereNotNull('det.id_protocolo')
                    ->get();
    return DataTables::of($protocolos)
                        ->addColumn('ver',function(){
                            return '<button class="btn btn-sm btn-outline-secondary" style="font-size:13px;"> Ver </button>';
                        })
                        ->addColumn('codigo',function($protocolo){
                            return $protocolo->codigo->color;
                        })
                        ->addColumn('especialidad',function($protocolo){
                            $l="";
                            foreach($protocolo->detalle_protocolo as $det)
                                $l=$l.$det->especialidad->nombre;
                            return $l;
                        })
                        ->addColumn('sintomas',function($protocolo){
                             $s="";
                            foreach($protocolo->det_sintomas_protocolos as $det)
                                $s=$s.$det->sintoma->descripcion.'-';
                            return $s;
                        })
                        ->addColumn('buttons',function($protocolo){
                            return '<a class="btn btn-sm btn-outline-secondary ml-1"href="/editarProtocolo/'.$protocolo->id.'">Editar</a>'.'<button class="btn btn-outline-secondary btn-sm ml-1" onclick="eliminar('.$protocolo->id.')">Eliminar</button>';
                        })
                        ->rawColumns(['codigo','especialidad','sintomas','ver','buttons'])
                        ->toJson();
});
Route::get('editprotocolo', function(){
    $sintomas = App\Sintoma::all();
    $id = $_GET['id'];
    $sintomas_actuales = DB::table('detalles_sintomas_protocolos as det_sintomas')
                                ->join('sintomas as s','s.id','=','det_sintomas.id_sintoma')
                                ->select('s.descripcion','s.id')
                                ->where('det_sintomas.id_protocolo','=',$id)
                                ->get();
    return DataTables::of($sintomas)
                        ->addColumn('checkbox', function($sintoma) use ($sintomas_actuales) {
                            $band = true;
                            $i = 0;
                            $tam = $sintomas_actuales->count();
                            while ($band and $i < $tam){
                                if ($sintoma->id == $sintomas_actuales[$i]->id){
                                    $band = false;
                                }
                                $i ++;
                            }
                            if ($band){
                                return '<input type="checkbox" name="cbs[]" value="'.$sintoma->id.'">';
                            }else{
                                return '<input type="checkbox" name="cbs[]" value="'.$sintoma->id.'" checked>';
                            }
                        })
                        ->rawColumns(['checkbox'])
                        ->toJson();
});

Route::get('tablasalas',function(Request $request){
    $salas=App\Sala::all();

    return DataTables::of($salas)
                        ->addColumn('area', function($sala){
                            return $sala->area->nombre;
                        })
                        ->rawColumns(['area'])
                        ->addColumn('habilita', function($sala){
                            return view('salas/habilitasala', compact('sala'));
                        })
                        ->rawColumns(['habilita'])
                        ->addColumn('elimina', function($sala){
                            return view('salas/elimina', compact('sala'));
                        })
                        ->rawColumns(['elimina'])
           ->toJson();
});
Route::get('tablaareas',function(Request $request){
    $areas=App\Area::all();
    return DataTables::of($areas)
            ->addColumn('botones', 'areas/botones')
            ->rawColumns(['botones'])
            ->toJson();
});


Route::get('tablausuario',function(){

    $usuarios = App\User::where('estado', 1)->get();
    return DataTables::of($usuarios)
                    ->addColumn('rol',function($usuario){
                        return $usuario->rol->nombre;
                    })
                    ->addColumn('estado',function($usuario){
                        if($usuario->isOnline()){
                            return '<li class="list-group-item list-group-item-success">Online</li>';
                        }else{
                            return '<li class="list-group-item list-group-item-danger">Offline</li>';
                        }
                    })
                    ->addColumn('buttons',function($usuario){
                        return view('usuarios/buttons',compact('usuario'));
                    })
                    ->rawColumns(['rol','estado','buttons'])
            ->toJson();
            // @if( $usuario->isOnline() )
			// 				<li class="text-success">Online</li>
			// 			@else
			// 				<li class="text-muted">Offline</li>
			// 			@endif
});

Route::get('usuariospendientes',function(){
    $usuarios = App\User::where('estado', 0)->get();
     return DataTables::of($usuarios)
                    ->addColumn('rol',function($usuario){
                        return $usuario->rol->nombre;
                    })
                    ->addColumn('buttons',function($usuario){
                        return view('usuarios/buttons_pendientes',compact('usuario'));
                    })
                    ->rawColumns(['rol','buttons'])
            ->toJson();
});