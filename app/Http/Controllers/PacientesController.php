<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paciente;
use App\Codigo;
use App\Atencion;
use App\DetalleAtencion;
use App\Historial;
use App\CIE;
use DB;

class PacientesController extends Controller
{
    public function index()
    {
        
        $pacientes= DB::table('Pacientes')->get();
        //$pacientes = Paciente::all()->paginate(10);
        $colores = Codigo::all();
        $cie = DB::table("cie as c")->get();
        return view('pacientes.index', compact('pacientes','colores','cie'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pacientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
           $pacientes=Paciente::where('dni',$request->get('dni'))->get();
        if($pacientes->count()){
            $rta="el dni del paciente ingresado ya está cargado.";
        }else{
            $nuevo = new Paciente;
            $nuevo->dni=$request->get('dni');
            $nuevo->nombre=$request->get('nombre');
            $nuevo->apellido=$request->get('apellido');
            $nuevo->domicilio=$request->get('direccion');
            $nuevo->telefono=$request->get('telefono');
            $nuevo->fechaNac=$request->get('fechaNac');
            $nuevo->sexo=$request->get('sexo');
            $nuevo->save();
        }
        return redirect()->action('PacientesController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
        $paciente = Paciente::findOrFail($id);

        $nn= DB::table("Pacientes as p")
                ->join("Atencion as a",'a.Paciente_id','=','p.Paciente_id')
                ->join("detalle_atencion as da",'da.id_atencion','=','a.id')
                ->join("historial as h",'h.id_detalle_atencion','=','da.id')
                ->select("p.fechaNac",'h.descripcion','a.id as id_atencion')
                 ->where("p.nombre",'=',"nn")
                 ->where("p.apellido",'=','nn')
                 ->get();
        return view('pacientes.edit', compact('paciente','nn','id'));
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
        if($request->comprobador == 1){
            $nuevo = Paciente::findOrFail($id);
            $nuevo->dni=$request->get('dni');
            $nuevo->nombre=$request->get('nombre');
            $nuevo->apellido=$request->get('apellido');
            $nuevo->domicilio=$request->get('direccion');
            $nuevo->telefono=$request->get('telefono');
            $nuevo->fechaNac=$request->get('fechaNac');
            $nuevo->sexo=$request->get('sexo');
            $nuevo->save();

        }
        else{
            $atencion= Atencion::findOrFail($id);
            $atencion->Paciente_id=$request->id_paciente;
            $atencion->save();
        }
        
        $message="El pacientes fue editado exitosamente";
            
        return redirect()->action("PacientesController@index")->with('success',$message);
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

    // public function shows(Request $request){
    //     $documento=$request->get('doc');
    //     $pacientes = Paciente::where('dni',$documento)->get();
    //     return view('pacientes.shows',compact('pacientes','documento'));
    // }

    public function insertarNN(Request $request){

            date_default_timezone_set('UTC');

            date_default_timezone_set("America/Argentina/Buenos_Aires");

            $nuevo = new Paciente;
            $nuevo->dni=0;
            $nuevo->nombre="nn";
            $nuevo->apellido="nn";
            $nuevo->domicilio="nn";
            $nuevo->telefono="1";
            $nuevo->fechaNac=date('Y-m-d-H:i');
            $nuevo->sexo="Masculino";

            $nuevo->save();

            $atencion = new Atencion;
            $atencion->Paciente_id = $nuevo->Paciente_id;
            $atencion->usuario_id = 1;
            $atencion->save();

            $detalleatencion = new DetalleAtencion;
            $detalleatencion->fecha=date('Y-m-d');
            $detalleatencion->hora=date('H:i');
            $detalleatencion->id_especialidad = 5; // CAMBIAR POR OTRA ID O HACER NULL LA ESPECIALIDAD
            $detalleatencion->atendido=0;
            $detalleatencion->id_atencion =$atencion->id;
            $detalleatencion->estado=$request->condicion;
            if($request->condicion == "Internar"){
                if($request->selectop == "si"){
                    $detalleatencion->operar=1;
                }
            }
            $detalleatencion->id_codigo_triage = $request->id_color;
            $detalleatencion->save();

            $historial = new Historial;
            $historial->id_detalle_atencion = $detalleatencion->id;
            $historial->descripcion = $request->observacion;
            $historial->id_cie = $request->radiocie;
            $historial->fecha=date('Y-m-d');
            $historial->hora  = date('H:i');
            $historial->save();
            $message="El paciente fue cargado exitosamente";
            
            return redirect()->action("PacientesController@index")->with('success',$message);
        
    }
}
