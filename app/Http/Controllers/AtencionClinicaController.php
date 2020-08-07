<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Pregunta;
use App\Sala;
use DB;

use App\Historial;
use App\Atencion;
use App\Area;
use App\Especialidad;
use App\CIE;
use App\DetalleAtencion;

use App\DetalleProfSala;
use Auth;

class AtencionClinicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        date_default_timezone_set('UTC');

        date_default_timezone_set("America/Argentina/Buenos_Aires");
        $mensaje=$request->mensaje;
        $pacientes="";
        $especialidades="";
        if($request->mensaje!=""){
            
            $pacientes= DB::table('detalle_atencion as da')
                    ->join('det_especialidad_area as det_e_a','det_e_a.id_especialidad','=','da.id_especialidad')
                    ->join('Areas as are','are.id','=','det_e_a.id_area')
                    ->join('Especialidades as esp','esp.id','=','det_e_a.id_especialidad')
                    ->join('Atencion as a','a.id','=','da.id_atencion')
                    ->join('Protocolos as prot','prot.id','=','a.id_protocolo')
                    ->join('Pacientes as p','p.Paciente_id','=','a.Paciente_id')
                    ->join('CodigosTriage as codigotriage','codigotriage.id','=','da.id_codigo_triage')
                    ->select('p.nombre','p.apellido','da.fecha','da.id_atencion','prot.id_codigo_triage','are.tipo_dato','esp.nombre as especialidad','da.id','codigotriage.color')
                    ->where('da.fecha','=',date('Y-m-d'))
                    ->where('da.atendido','=',0)
                    ->where('da.estado','LIKE','consulta')
                    ->orderBy('prot.id_codigo_triage','DESC')
                    ->orderBy('da.id','ASC')
                    ->get();
            $especialidades=Especialidad::all();

        }

        
       
        $areas=Area::all();
        $salas=DB::table("salas as s")
                   ->join("areas as a",'a.id','=','s.id_area')
                   ->select('a.tipo_dato','s.nombre','s.id')
                   ->orderBy('a.tipo_dato')
                   ->get();

        
            $val1=$request->val1;
            $val2=$request->val2;
       
            
        return view('atencionclinica.index', compact('pacientes','areas','especialidades','val1','val2','salas','mensaje'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Aca cargamos los datos utilizados
        // $actualizar_detalle=DetalleAtencion::findOrFail($request->detalleatencion);
        // $actualizar->id_det_profesional_sala=...
        // $actualizar->save();
        
        

        date_default_timezone_set('UTC');
        date_default_timezone_set("America/Argentina/Buenos_Aires");
 
        $actualizar_detalle=DetalleAtencion::findOrFail($request->detalleatencion1);
        $actualizar_detalle->fecha=date('Y-m-d');
        $actualizar_detalle->hora=date('H:i');
        $actualizar_detalle->respuestas=$request->descripto;

        echo $request->descripto;

        if (isset($_POST['boton'])) {
            $actualizar_detalle->atendido=1;
            $actualizar_detalle->estado=$request->internar;
            if($request->internar == "Internar"){
            if($request->op == "si"){
                
                $actualizar_detalle->operar=1;
            }
            }
            $id_color=DB::table('CodigosTriage')->select('id')->where('color','LIKE',$request->color)->get();
            $actualizar_detalle->id_codigo_triage=$id_color[0]->id;
            $actualizar_detalle->save();

            $nuevo=new Historial;
            $nuevo->id_detalle_atencion=$request->detalleatencion1;
            $codigocie=explode("-", $request->cieslist);
            $id_cie=CIE::select('id')->where('codigo','=',$codigocie[0])->get();
            $nuevo->id_cie=$id_cie[0]->id;
            $nuevo->descripcion= $request->observacion;
            $nuevo->fecha=date('Y-m-d');
            $nuevo->hora=date('H:i');
            $nuevo->save();

        } 
        else{
            $actualizar_detalle->save();
        }

        $mensaje = $request->mensaje;
        $val1=$request->val1;
        $val2=$request->val2;
        // if($request->internar == "alta"){
        //      $actualizar_detalle->atendido=1;
        // }
        // else{
        //     $actualizar_detalle->estado=$request->internar;
        // }
        // if($request->internar == "Internar"){
        //     if($request->op == "si"){
                
        //         $actualizar_detalle->operar=1;
        //     }
            
        // }
        // $id_color=DB::table('CodigosTriage')->select('id')->where('color','LIKE',$request->color)->get();
        // $actualizar_detalle->id_codigo_triage=$id_color[0]->id;
        // $actualizar_detalle->save();


        // $nuevo=new Historial;
        // $nuevo->id_detalle_atencion=$request->detalleatencion1;
        // $codigocie=explode("-", $request->cieslist);
        // $id_cie=CIE::select('id')->where('codigo','=',$codigocie[0])->get();
        // $nuevo->id_cie=$id_cie[0]->id;
        // $nuevo->descripcion= $request->observacion;
        // $nuevo->fecha=date('Y-m-d');
        // $nuevo->hora=date('H:i');
        // $nuevo->save();

        return redirect()->action('AtencionClinicaController@index',['mensaje'=>$mensaje,'val1'=>$val1,'val2'=>$val2]);

       

       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        date_default_timezone_set('UTC');

        date_default_timezone_set("America/Argentina/Buenos_Aires");
        $mensaje =$request->mensaje;


        $pacientes= DB::table('detalle_atencion as da')
                    ->join('det_especialidad_area as det_e_a','det_e_a.id_especialidad','=','da.id_especialidad')
                    ->join('Areas as are','are.id','=','det_e_a.id_area')
                    ->join('Especialidades as esp','esp.id','=','det_e_a.id_especialidad')
                    ->join('Atencion as a','a.id','=','da.id_atencion')
                    ->join('Protocolos as prot','prot.id','=','a.id_protocolo')
                    ->join('Pacientes as p','p.Paciente_id','=','a.Paciente_id')
                    ->join('CodigosTriage as codigotriage','codigotriage.id','=','da.id_codigo_triage')
                    ->select('p.nombre','p.apellido','da.fecha','da.id_atencion','prot.id_codigo_triage','are.tipo_dato','esp.nombre as especialidad','p.Paciente_id','da.id','da.respuestas','codigotriage.color')
                    ->where('da.fecha','=',date('Y-m-d'))
                    ->where('da.atendido','=',0)
                    ->where('da.estado','LIKE','consulta')
                    ->orderBy('prot.id_codigo_triage','DESC')
                    ->orderBy('da.id','ASC')
                    ->get();
        $especialidades=Especialidad::all();
        $areas=Area::all();

        $val1=$request->val1;
        $val2=$request->val2;

        $detalleatencion=$request->detalleatencion;
        

        $preguntas= DB::table('preguntas as p')
                    ->join('Sintomas as s','p.id_sintoma','=','s.id')
                    ->select('s.descripcion')
                    ->where('p.id_atencion','=',$id)
                    ->get();
        $id_paciente=DB::table('Atencion as a')
                        ->select('a.Paciente_id')
                        ->where('a.id','=',$id)
                        ->get();

        $paciente_seleccionado= DB::table("detalle_atencion as da")
                                    ->where('da.id','=',$detalleatencion)
                                    ->get();
        $paciente_seleccionado=$paciente_seleccionado[0];

        $historial=DB::table('historial as h')
                     ->join('detalle_atencion as dt','dt.id','=','h.id_detalle_atencion')
                     ->join('Atencion as a','a.id','=','dt.id_atencion')
                     
                     ->join('cie as c','c.id','=','h.id_cie')
                     ->select('c.descripcion','c.codigo','h.descripcion as observacion')
                     ->where('a.Paciente_id','=',$id_paciente[0]->Paciente_id)
                    
                    ->get();
        
        
        $cie=CIE::all();

        $codigos = DB::table('CodigosTriage')->get();

        return view('atencionclinica.show', compact('pacientes','preguntas','areas','especialidades','id','codigos','val1','val2','historial','cie','detalleatencion','paciente_seleccionado','mensaje'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
            $id_sala_prof = DB::table('det_profesionales_salas as det')
                                ->join('profesionales as p','p.id','=','det.id_profesional')
                                ->select('det.id')
                                ->where('p.id_user','=',$id)
                                ->get();
            $actualizar = DetalleProfSala::findOrFail($id_sala_prof[0]->id);
            $actualizar->disponibilidad=0;
            $actualizar->save();
            return redirect()->action('AtencionClinicaController@index');
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
        //
        echo "buebas";
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
    }

    public function cargarSala(Request $request){
       
       $id_profesional=DB::table("users as u")
                         ->join("profesionales as pro","pro.id_user",'=','u.id')
                         ->select("pro.id")
                         ->where("u.id",'=',Auth::id())
                         ->get();
       $cadena=explode('-',$request->sala);
       $mensaje="Te encuentras en ".$cadena[1];
       $consulta = DB::table("det_profesionales_salas as dt")
                        ->join("profesionales as p",'p.id','=','dt.id_profesional')
                        ->select("dt.id")
                        ->join("users as u",'u.id','=','p.id_user')
                        ->where("u.id",'=',Auth::id())
                        ->get();
       if(count($consulta)>0){
        $nuevo= DetalleProfSala::findOrFail($consulta[0]->id);
        $nuevo->id_sala=(int)$cadena[0];
        $nuevo->disponibilidad=1;
        $nuevo->save();
       }
       else{
        $nuevo = new DetalleProfSala;
       $nuevo->id_profesional=$id_profesional[0]->id;
       $nuevo->id_sala=(int)$cadena[0];
       $nuevo->disponibilidad=1;
       $nuevo->save();
       }
       

      return redirect()->action("AtencionClinicaController@index",['mensaje'=>$mensaje]);

    }
    
}
