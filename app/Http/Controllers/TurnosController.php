<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DetalleHorario;
use App\DetalleSala;
use App\Horario;

use App\Paciente;
use App\Area;
use App\Sala;
use App\Medico;

use DB;

use App\DetalleAtencion;
use App\Especialidad;
use App\Protocolo;
use App\Detalle_Sintoma_Protocolo;
use App\DetalleProtocolo;


class TurnosController extends Controller
{
     public function index(Request $request)

    {	 
        $id_atencion=$request->get('atencion');
        $id_protocolo=$request->get('protocolo');

        // if($request->codigo =='' or $request->codigo=="verde"){
            $esp_sala=DB::table('Salas as s')
                    ->join('Detalle_Salas as dh','dh.id_salas','=','s.id')
                    ->join('Especialidades as es','es.id','=','s.id_especialidades')
                    ->where('dh.id_protocolo','=',$id_protocolo)
                    ->select('es.nombre')
                    ->groupBy('es.nombre')
                    ->get();

            $day="";
            $seleccionar="";
            $horarios=DB::table('Horarios as h')
              ->join('Detalle_Salas as ds','ds.id_salas','=','h.id_salas')
              ->where('ds.id_protocolo','=',$id_protocolo)
              ->get();

            $medicos="";
            $turnos="";

            if($request->get('date')!='' or $request->get('new_date')!='' ){
               // print_r("printiamos dia".$request->get('date'));
                $day=$request->get('date');
                if($day==''){$day= $request->get('new_date');}

                $dias = array('Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado');
                $fecha = $dias[date('N', strtotime($day))];
                
                $medicos=DB::table('Horarios as h')
              ->join('Detalle_Salas as ds','ds.id_salas','=','h.id_salas')->select('h.id','h.horaInicio','h.horaFin')
              ->where('ds.id_protocolo','=',$id_protocolo)
              ->where('h.fechas','like',$fecha)
              ->get();
            }
            if($request->get('seleccionado')!=''){
                    $array=explode(" ", $request->get('seleccionado'));
                    $day=$request->get('new_date');
                    $seleccionar=$request->get('seleccionado');

                    //print_r($array);


                    $turnos=DB::table('Detalle_Horarios as dh')
                    //->join('Detalle_Atencion as da','da.id','=','dh.id_detalle_atencion')
                    ->join('Atencion as a','a.id','=','dh.id_atencion')
                    ->join('Pacientes as p','p.Paciente_id','=','a.Paciente_id')
                    ->join('Horarios as h','h.id','=','dh.id_horarios')
                    ->join('Salas as s','s.id','=','h.id_salas')
                    ->join('Areas as ar','ar.id','=','s.id_area')
                    ->join('Medicos as me','me.id','=','h.id_medico')
                    ->select('dh.start','me.nombre_med','me.apellido_med','p.dni','p.nombre','p.apellido','h.id_salas','ar.tipo_dato')
                    //->where('a.id','=',$id_atencion)
                    ->where('dh.id_horarios','=',$array[1])
                    ->where('dh.start','=',$day)
                    ->get();


                    
                }

            // return view('turnos.index',compact('horarios','medicos','day',"turnos",'seleccionar','id_atencion', 'id_protocolo','esp_sala'));
        

  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	 
      date_default_timezone_set('UTC');

      date_default_timezone_set("America/Argentina/Buenos_Aires");
      
      // $actualizar_detalle=DetalleAtencion::findOrFail($request->detalleatencion);
      // $actualizar_detalle->estado=$request->tipo;
      // $actualizar_detalle->sala=$request->sala;
      // $actualizar_detalle->fecha=date('Y-m-d');
      // $actualizar_detalle->hora=date('H:i');
      // if($request->tipo == "Operado"){
      //   $actualizar_detalle->operar=0;
      //   $sala_actualizar= Sala::findOrFail($request->id_sala);
      //   $sala_actualizar->disponibilidad=0;
      //   $sala_actualizar->save();
      // }
      // $actualizar_detalle->save();

      $actualizar_detalle=DetalleAtencion::findOrFail($request->get('detalleatencion'));
      $actualizar_detalle->estado=$request->get('tipo');
      $actualizar_detalle->sala=$request->get('sala');
      $actualizar_detalle->fecha=date('Y-m-d');
      $actualizar_detalle->hora=date('H:i');
      if($request->get('tipo') == "Operado"){
        $actualizar_detalle->operar=0;
        $sala_actualizar= Sala::findOrFail($request->get('id_sala'));
        $sala_actualizar->disponibilidad=0;
        $sala_actualizar->save();
      }
      $actualizar_detalle->save();

      // $resultado = $relevamiento->save();
        if ($actualizar_detalle) {
            return response()->json(['success'=>'true']);
        }else{
            return response()->json(['success'=>'false']);
        }
      // return redirect()->action('TurnosController@mostrar');


        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
  	    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {

      date_default_timezone_set('UTC');

      date_default_timezone_set("America/Argentina/Buenos_Aires");
      

      $actualizar_detalle=DetalleAtencion::findOrFail($id);
      $actualizar_detalle->estado="alta";
     
      $actualizar_detalle->fecha=date('Y-m-d');
      $actualizar_detalle->hora=date('H:i');
      
      
      $actualizar_detalle->save();

      return redirect()->action('TurnosController@mostrar');
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        
        // $nombre="";
        // $detallehorario=DetalleAtencion::findOrFail($id);
        // $detallehorario->atendido=1;
        // $detallehorario->save();
        // $val1=$request->a;
        // $val2=$request->m;
        // if($request->control != ""){
        //   $salas=DB::table('Salas as s')
        //           ->join('Areas as a','a.id','=','s.id_area')
        //           ->select('s.id','s.estado','s.nombre')
        //           ->where('a.tipo_dato','LIKE','Quirofanos') // poner QUIROFANO ACA
        //           ->where('s.estado','=',1)
        //           ->get();
        //   $sala=Sala::findOrFail($salas[0]->id);
        //         $sala->estado=0;
        //         $sala->save();
        //   $nombre=$sala->nombre;
          
        // }
        // return redirect()->action('TurnosController@mostrar',['val1'=>$val1,'val2'=>$val2,'sala'=>$nombre]);
        // return redirect()->action('TurnosController@mostrar',['id_med'=>$request->id_medico]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
      $eliminar= DetalleAtencion::findOrFail($id);
      $eliminar->delete();
      return redirect()->action('PacientesController@index');
    }


    public function mostrar(Request $request){

      date_default_timezone_set('UTC');
      date_default_timezone_set("America/Argentina/Buenos_Aires");

      $especialidades=Especialidad::all();



      $pacientes= DB::table('detalle_atencion as da')
                    ->join('det_especialidad_area as det_e_a','det_e_a.id_especialidad','=','da.id_especialidad')
                    ->join('Areas as are','are.id','=','det_e_a.id_area')
                    ->join('Especialidades as esp','esp.id','=','det_e_a.id_especialidad')
                    ->join('Atencion as a','a.id','=','da.id_atencion')
                    ->join('Pacientes as p','p.Paciente_id','=','a.Paciente_id')
                    ->join('CodigosTriage as codigotriage','codigotriage.id','=','da.id_codigo_triage')
                   
                    ->select('p.nombre','p.apellido','da.fecha','da.hora','are.tipo_dato','esp.nombre as especialidad','da.estado','da.id_codigo_triage','da.id','da.sala','codigotriage.color','da.operar')
                    // ->where('da.fecha','=',date('Y-m-d'))
                    
                    ->orderBy('da.id_codigo_triage','DESC')
                    ->orderBy('da.fecha','ASC')
                    ->orderBy('da.hora','ASC')
                    ->get();
      
      $historial=DB::table('historial as h')
                     ->join('cie as c','c.id','=','h.id_cie')
                     ->select('h.descripcion as observacion','c.codigo','c.descripcion','h.id_detalle_atencion')
                     //->where('h.fecha','=',date('Y-m-d'))
                     ->get(); 
      

      $salas= DB::table('salas as s')
                  ->join('Areas as a','a.id','=','s.id_area')
                  ->select('a.tipo_dato','s.nombre','s.camas','s.disponibilidad','s.id')
                  ->get();
      // $cantidad = DB::table('detalle_atencion as a')
      //                 ->join('salas as s','s.nombre','like','a.sala')
      //                 ->select('a.sala',DB::raw('count(*) as reserves_count'))
      //                 ->where('a.estado','like','Internado')           
      //                 ->groupBy('sala')
      //                 ->get();
      

       return view('turnos.mostrar',compact('especialidades','pacientes','historial','salas'));
     }
        
    

     public function respuesta(Request $request)
    {
      $msj_especialidades=array();
      $nombres_especialidades=array();
      $color="";
      $casos="";
      $especialidades=DB::table('Especialidades')->orderBy('nombre','ASC')->get();
      $codigos=DB::table('CodigosTriage')->orderBy('color')->get();
      $atencion=$request->get('atencion');
      $sintomas=$request->sintomas;

      $protocolos = DB::table('Detalles_Sintomas_Protocolos as det')
                            ->join('Protocolos as prot','prot.id','=','det.id_protocolo')
                            ->join('Sintomas as s','s.id','=','det.id_sintoma')
                            ->join('det_protocolos as det_prot','det_prot.id_protocolo','=','det.id_protocolo')
                            ->join('Especialidades as esp','esp.id','=','det_prot.id_especialidad')
                            ->join('CodigosTriage as cod','cod.id','=','prot.id_codigo_triage')
                            ->select("det.id_protocolo", DB::raw('count(*) as cantidad','det.id_protocolo'),'det_prot.id_especialidad','esp.nombre','cod.color')
                            ->whereIn('s.id',$request->sintomas)
                            ->groupBy('det.id_protocolo')
                            ->groupBy('det_prot.id_especialidad')
                            ->groupBy('esp.nombre')
                            ->groupBy('cod.color')
                            ->orderBy('cantidad','DESC')
                            ->orderBy('prot.id_codigo_triage','DESC')
                            ->get();
      if(sizeof($protocolos)>0){
        // BUSCAMOS EL PROTOCOLO 
        
        foreach ($protocolos as $prot) {
          $cant = DB::table('Detalles_Sintomas_Protocolos as det')
                      ->where('det.id_protocolo','=',$prot->id_protocolo)
                      ->count();
          if(sizeof($request->sintomas)==$cant){
            #Encontramos el protocolo
            if(sizeof($nombres_especialidades)==0){
              array_push($nombres_especialidades, $prot->nombre);
              $color=$prot->color;
            }
            else{
              $band = array_search($prot->nombre,$nombres_especialidades, false);
              if($band == ""){
                array_push($nombres_especialidades, $prot->nombre);
              }
            }
          }
        }
        // print_r($nombres_especialidades);
        if(sizeof($nombres_especialidades)!=0){
          #Tenemos protocolos ahora buscamos cuantos especialistas se encuentran disponibles.
          $disponibles=DB::table('det_profesionales as det_pro')
                         ->join('profesionales as prof','prof.id','=','det_pro.id_profesional')
                         ->join('Especialidades as esp','esp.id','=','det_pro.id_especialidad')
                         ->select('esp.nombre',DB::raw('count(*) as cantidad','esp.nombre'))
                         ->whereIn('esp.nombre',$nombres_especialidades)
                         ->where('prof.disponibilidad','=',1)
                         ->groupBy('esp.nombre')
                         ->get();

          if(sizeof($disponibles)>0){
            $casos="disponibles";
          #Armamos el msj de cuantos disponibles hay
            
            foreach ($disponibles as $d) {
              $temp_msj=$d->nombre.":".$d->cantidad;
              array_push($msj_especialidades, $temp_msj);
            }
            
          }
          else{
            #En este caso no hay persona disponibles :D 
          #mandamos los nombres de especialidades
            $casos="no disponibles";
          

          }
        }
        else{
          // No se encontro un protocolo pero si tenemos coincidencias con otros protocolos :D
          $casos="probabilidades";
          $lista_probabilidades=array();
          $lista_nombres_especialidades=array();
          foreach ($protocolos as $p) {
           
            array_push($lista_nombres_especialidades,$p->nombre);
            array_push($lista_probabilidades,$p->cantidad*100/sizeof($request->sintomas).'%'.' Codigo: '.$p->color);
          }
          $nombres_especialidades=array_unique($lista_nombres_especialidades);
          foreach ($nombres_especialidades as $r ) {
            $indice=array_search($r, $lista_nombres_especialidades, false);
            $msg=$r." coincidencia de un:".$lista_probabilidades[$indice];
            array_push($msj_especialidades,$msg);
          }
          


        }
      }
      else{
        #en caso de que no existe ningun protocolo!
        $casos="no protocolo";
        
      }
      return view('turnos.respuesta',compact('nombres_especialidades','msj_especialidades','color','casos','especialidades','codigos','atencion','sintomas'));


    }

    public function cargaratencion(Request $request){
      date_default_timezone_set('UTC');
      date_default_timezone_set("America/Argentina/Buenos_Aires");
      if($request->get('casos')=="disponibles" or $request->get('casos')=="no disponibles"){
        $nuevo=new DetalleAtencion;
        $nuevo->id_atencion=$request->atencion;
        $nuevo->id_especialidad=$request->esp;
        $id_codigo=DB::table('CodigosTriage')->select('id')->where('color','LIKE',$request->color)->get();
        $nuevo->id_codigo_triage=$id_codigo[0]->id;
        $nuevo->fecha=date('Y-m-d');
        $nuevo->hora=date('H:i');
        $nuevo->atendido=0;
        $nuevo->estado="consulta";
        $nuevo->save();
      }
      else{
        $nuevo=new DetalleAtencion;
        $nuevo->id_atencion=$request->atencion;
        $nuevo->id_especialidad=$request->esp;
        $nuevo->id_codigo_triage=$request->color;
        $nuevo->fecha=date('Y-m-d');
        $nuevo->hora=date('H:i');
        $nuevo->atendido=0;
        $nuevo->estado="consulta";
        $nuevo->save();
        if($request->radios == "si"){
          $cantidad= DB::table("Protocolos")
                         ->where("descripcion","LIKE","DEFECTO%")
                         ->count();                    
          $nuevo_protocolo = new Protocolo;
          $nuevo_protocolo->descripcion = "DEFECTO".$cantidad;
          $nuevo_protocolo->id_codigo_triage=$request->color;
          $nuevo_protocolo->save();

          $nuevo_detalle= new DetalleProtocolo;
          $nuevo_detalle->id_protocolo= $nuevo_protocolo->id;
          $nuevo_detalle->id_especialidad=$request->esp;
          $nuevo_detalle->save();
          

          foreach(json_decode($request->sintomas, true) as $value){
              $sintomas_detalle_protocolo = new Detalle_Sintoma_Protocolo;
              $sintomas_detalle_protocolo->id_protocolo=$nuevo_protocolo->id;
              $sintomas_detalle_protocolo->id_sintoma = $value;
              $sintomas_detalle_protocolo->save();
             
          }

        }
      }

      return redirect()->action('PacientesController@index');
    }
    

}
