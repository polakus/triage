<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use App\User;

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

Route::get('ApiPacientes/{us}',function(User $us){
  
    $pacientes= DB::table('pacientes')->where('nombre','!=','nn')->where('apellido','!=','nn')->get();

    return DataTables::of($pacientes)
                       // ->addColumn('btn','pacientes/botones')
                        ->addColumn('btn', function($paciente) use ($us){
                            return view('pacientes/botones',compact('paciente','us'));
                        })

                       ->rawColumns(['Accion','btn'])
    ->toJson();
});


Route::get('mostrar/{us}', function(User $us){
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

                    ->orderBy('da.id_codigo_triage','ASC')
                    // ->orderBy('da.fecha','DESC')
                    // ->orderBy('da.hora','ASC')
                    ->orderBy('a.dias','DESC')
                    ->orderBy('a.horas','DESC')
                    ->get();

    $salas_internacion = DB::table('salas as s')
                    ->join('areas as a','a.id','=','s.id_area')
                    ->join('configuracion_areas as conf','conf.id_area','=','a.id')
                    ->select('a.nombre','s.nombre','s.camas','s.disponibilidad','s.id')
                    ->where('conf.nombre','=','internacion')
                    ->get();
    $salas_operacion = DB::table('salas as s')
                    ->join('areas as a','a.id','=','s.id_area')
                    ->join('configuracion_areas as conf','conf.id_area','=','a.id')
                    ->select('a.nombre','s.nombre','s.camas','s.disponibilidad','s.id')
                    ->where('conf.nombre','=','operacion')
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
                        ->addColumn('Internacion', function($paciente) use($salas_internacion, $us){
                            if($us->can('FullAtencion') or $us->can('InternacionAtencion')){
                                return view('turnos/actionsInternar',compact('paciente','salas_internacion'));
                            }
                        })
                        // ->addColumn('Operar','turnos/actionsOperar')
                        ->addColumn('Operar', function($paciente) use ($salas_operacion, $us){
                            if($us->can('FullAtencion') or $us->can('OperacionAtencion')){
                                return view('turnos/actionsOperar', compact('paciente', 'salas_operacion'));
                            }
                        })
                        ->addColumn('DarAlta', function($paciente) use($us){
                            return view('turnos/daralta', compact('paciente','us'));
                        })
                        ->rawColumns(['observacion','Internacion','Operar','DarAlta'])
                    ->toJson();
});


Route::get('sintomas_cargar/{us}', function(User $us){
     $sintomas=DB::table('sintomas')->get();
     return DataTables::of($sintomas)
                       ->addColumn('button',function($sintoma) use ($us){
                        return view('sintomas/action_editar_eliminar',compact('sintoma','us'));
                       })
                       ->rawColumns(['button'])
    ->toJson();
});

Route::get('cargar_cie/{us}', function(User $us){
    // $enfermedades = App\CIE::all();
    $enfermedades = DB::table('cie')->orderBy('codigo')->get();
    $s = '<div class="d-flex w-100">';
    if($us->hasAnyPermission(['FullCie','EditarCie']) && $us->hasAnyPermission(['FullCie','EliminarCie'])){
        return DataTables::of($enfermedades)
            ->addColumn('button', function($enfermedad) use($s) {
                $s=$s.'<button id="btn-editar-'.$enfermedad->id.'" onclick="iniModalEditar(\''.$enfermedad->codigo.'\',\''.$enfermedad->descripcion.'\',\''.$enfermedad->id.'\')" type="button" class="btn btn-outline-secondary btn-sm "  data-toggle="modal" data-target="#editar">
                            Editar
                        </button>
                        <button onclick="iniModalEliminar(\''.$enfermedad->codigo.'\',\''.$enfermedad->descripcion.'\',\''.$enfermedad->id.'\')" type="button" class="btn btn-outline-secondary btn-sm ml-1" data-toggle="modal" data-target="#modalEliminar" >
                            Eliminar
                        </button>';
                $s = $s.'</div>';
                return $s;
                })
                ->rawColumns(['button'])
                ->toJson();
    }elseif($us->hasAnyPermission(['FullCie','EditarCie'])){
        return DataTables::of($enfermedades)
            ->addColumn('button', function($enfermedad) use($s) {
                $s=$s.'<button id="btn-editar-'.$enfermedad->id.'" onclick="iniModalEditar(\''.$enfermedad->codigo.'\',\''.$enfermedad->descripcion.'\',\''.$enfermedad->id.'\')" type="button" class="btn btn-outline-secondary btn-sm "  data-toggle="modal" data-target="#editar">
                            Editar
                        </button>';
                $s = $s.'</div>';
                return $s;
            })
            ->rawColumns(['button'])
            ->toJson();
    }elseif($us->hasAnyPermission(['FullCie','EliminarCie'])){
        return DataTables::of($enfermedades)
            ->addColumn('button', function($enfermedad) use($s) {
                $s=$s.'<button type="button" class="btn btn-outline-secondary btn-sm ml-1" data-toggle="modal" data-target="#modalEliminar" >
                            Eliminar
                        </button>';
                $s = $s.'</div>';
                return $s;
            })
            ->rawColumns(['button'])
            ->toJson();
    }
    return DataTables::of($enfermedades)
            ->addColumn('button', function($enfermedad) use($s) {
                $s = $s.'</div>';
                return $s;
            })
            ->rawColumns(['button'])
            ->toJson();
});
            
Route::get('dtespecialidades/{us}', function(User $us){
    // $especialidades = App\Especialidad::all();
    $especialidades = DB::table('especialidades as esp')
                        ->join('det_especialidad_area as det','det.id_especialidad','=','esp.id')
                        ->join('areas as a','a.id','=','det.id_area')
                        ->select('esp.id','esp.nombre as nombesp','esp.descripcion', 'a.nombre as nombarea', 'a.id as id_area')
                        ->get();
    $editareas = App\Area::all();
    // $area_seleccionada = App\Det_especialidad_area::where('id_especialidad', '=', $especialidades->id)->first()->area->id;
    return DataTables::of($especialidades)
                        ->addColumn('button', function($especialidad) use ($editareas,$us){
                            return view('especialidades/accion_editar', compact('editareas', 'especialidad', 'us'));
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

Route::get('protocolos/{us}',function(User $us){
    $protocolos=App\Protocolo::select('*')
                    ->join('det_protocolos as det','protocolos.id','=','det.id_protocolo')
                    ->whereNotNull('det.id_protocolo')
                    ->get();
    return DataTables::of($protocolos)
            ->addColumn('ver',function(){
                return '<button class="btn btn-sm btn-outline-secondary" style="font-size:12px;"> Ver </button>';
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
            ->addColumn('buttons',function($protocolo) use ($us){
                // $editar = $us->hasAnyPermission(['EditarProtocolo','FullProtocolos']) ? '<a class="btn btn-sm btn-outline-secondary ml-1"href="/protocolos/'.$protocolo->id.'/edit">Editar</a>' : '';
                // $eliminar = $us->hasAnyPermission(['EliminarProtocolo','FullProtocolos']) ? '<button class="btn btn-outline-secondary btn-sm ml-1" onclick="eliminar('.$protocolo->id.')">Eliminar</button>':'';
                // return $editar.$eliminar;
                return view('protocolos/botones',compact('protocolo','us'));
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

Route::get('tablasalas/{us}',function(Request $request, User $us){
    $salas=App\Sala::all();
    
    return DataTables::of($salas)
                ->addColumn('area', function($sala){
                    return $sala->area->nombre;
                })->rawColumns(['area'])
                ->addColumn('habilita', function($sala) use ($us){
                    if($us->hasAnyPermission(['HabilitarSala','FullSalas']))
                        return view('salas/habilitasala', compact('sala'));
                })->rawColumns(['habilita'])
                ->addColumn('elimina', function($sala) use($us){
                    if($us->hasAnyPermission(['EliminarSala','FullSalas']))
                        return view('salas/elimina', compact('sala'));
                })->rawColumns(['elimina'])
                ->toJson();
});
Route::get('tablaareas/{us}',function(Request $request, User $us){
    $areas=App\Area::all();
    return DataTables::of($areas)
            ->addColumn('botones', function($area) use($us){
                return view('areas/botones',compact('area','us'));
            })
            ->rawColumns(['botones'])
            ->toJson();
});


Route::get('tablausuario/{us}',function(User $us){

    $usuarios = App\User::where('estado', 1)->get();
    return DataTables::of($usuarios)
                    ->addColumn('estado',function($usuario){
                        if($usuario->isOnline()){
                            return '<li class="list-group-item list-group-item-success">Online</li>';
                        }else{
                            return '<li class="list-group-item list-group-item-danger">Offline</li>';
                        }
                    })
                    ->addColumn('buttons',function($usuario) use ($us){
                        return view('usuarios/buttons',compact('usuario','us'));
                    })
                    ->rawColumns(['estado','buttons'])
            ->toJson();
});

Route::get('usuariospendientes',function(){
    $usuarios = App\User::where('estado', 0)->get();
     return DataTables::of($usuarios)
                    // ->addColumn('rol',function($usuario){
                    //     return $usuario->rol->nombre;
                    // })
                    ->addColumn('buttons',function($usuario){
                        return view('usuarios/buttons_pendientes',compact('usuario'));
                    })
                    ->rawColumns(['buttons'])
            ->toJson();
});


Route::get('rolesApi/{us}', function(User $us){
    $roles = Spatie\Permission\Models\Role::all();
    return DataTables::of($roles)
                    ->addColumn('btnAccion',function($rol) use($us){
                        return view('/roles/boton',compact('rol','us'));})
                    ->rawColumns(['btnAccion'])
        ->toJson();

});
Route::get('permisos_roles', function(Request $request){
    $permisos = DB::table('roles')
                ->join('role_has_permissions as rol_perm','rol_perm.role_id','=','roles.id')
                ->join('permissions as permisos','permisos.id','=','rol_perm.permission_id')
                ->select('permisos.name')
                ->where('roles.id','=',$request->id)
                ->get();
    // $permisos = DB::table('role')->get();
    return response()->json(['permisos'=>$permisos]);
});

// Route::get('permisosApi', function(){
//     $permisos= Spatie\Permission\Models\Permission::all();
//     return DataTables::of($permisos)
//                         ->addColumn('btnAccion','roles/boton')

//                         ->rawColumns(['btnAccion'])
//                         ->toJson();

// });