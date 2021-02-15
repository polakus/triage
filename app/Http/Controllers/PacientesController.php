<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paciente;
use App\Codigo;
use App\Atencion;
use App\DetalleAtencion;
use App\Historial;
use Illuminate\Support\Facades\Auth;
use App\CIE;
use DB;

class PacientesController extends Controller
{
    public function index()
    {
        
        // $pacientes= DB::table('Pacientes')->where('nombre','!=','nn')->where('apellido','!=','nn')->get();
        //$pacientes = Paciente::all()->paginate(10);
        $colores = Codigo::all();
        $cie = DB::table("cie as c")->get();
        return view('pacientes.index', compact('colores','cie'));
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
        $pac = $this->validarPaciente($request);
        $pacU = $request->validate(['dni' => 'unique:pacientes'], ['unique' => 'Este documento ya se encuentra registrado.']);  #para que pregunte si el documento ya existe
        $nuevo = new Paciente;
        $nuevo->dni=$request->get('dni');
        $nuevo->nombre=$request->get('nombre');
        $nuevo->apellido=$request->get('apellido');
        $nuevo->domicilio=$request->get('direccion');
        $nuevo->telefono=$request->get('telefono');
        $nuevo->fechaNac=$request->get('fechaNac');
        $nuevo->sexo=$request->get('sexo');
        $nuevo->save();

        $request->session()->flash('alert-success', 'El paciente fue agregado exitosamente!');
        return redirect()->back()->withInput();
    }

    public function validarPaciente($request){
        $mensajes = [
            'required' =>'Este campo no debe estar vacio.',
            'max' => 'Este campo supera la capacidad máxima de caracteres.',
            'numeric' => 'Este campo requiere una valor numérico.',
            'date' => 'La fecha ingresada no es válida.',
            'unique' => 'Este documento ya se encuentra registrado',
        ];
        return $request->validate([
            'nombre' => 'required|max:255',
            'apellido' => 'required|max:255',
            'telefono' => 'required|numeric',
            'fechaNac' => 'required|date',
            'sexo' => 'required',
            'direccion' => 'required|max:255',
            'dni' => 'required|numeric',
        ], $mensajes);
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
                ->join("atencion as a",'a.Paciente_id','=','p.Paciente_id')
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
        if($request->comprobador == 1){
            $pac = $this->validarPaciente($request);
            $nuevo = Paciente::findOrFail($id);
            $nuevo->dni=$request->get('dni');
            $nuevo->nombre=$request->get('nombre');
            $nuevo->apellido=$request->get('apellido');
            $nuevo->domicilio=$request->get('direccion');
            $nuevo->telefono=$request->get('telefono');
            $nuevo->fechaNac=$request->get('fechaNac');
            $nuevo->sexo=$request->get('sexo');
            $nuevo->save();

        }else{
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



    public function insertarNN(Request $request){
            $mensajes = [
                'required' =>'Este campo no debe estar vacio.',
                'max' => 'Este campo supera la capacidad máxima de caracteres.',
                'numeric' => 'Este campo requiere una valor numérico.',
                'date' => 'La fecha ingresada no es válida.',
                'unique' => 'Este documento ya se encuentra registrado',
            ];
            $r=$request->validate([
            'ciess' => 'required|max:255',
            'observacion' => 'required|max:255',
            ], $mensajes);
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
            $atencion->usuario_id = Auth::id();
            $atencion->save();

            $detalleatencion = new DetalleAtencion;
            $detalleatencion->fecha=date('Y-m-d');
            $detalleatencion->hora=date('H:i');
            $detalleatencion->id_especialidad = 5; // CAMBIAR POR OTRA ID O HACER NULL LA ESPECIALIDAD
            $detalleatencion->atendido=0;
            $detalleatencion->id_atencion =$atencion->id;
            $detalleatencion->estado=$request->get('condicion');
            if($request->get('condicion') == "Internar"){
                if($request->get('selectop') == "si"){
                    $detalleatencion->operar=1;
                }
            }
            $detalleatencion->id_codigo_triage = $request->get('id_color');
            $detalleatencion->save();

            $historial = new Historial;
            $historial->id_detalle_atencion = $detalleatencion->id;
            $historial->descripcion = $request->get('observacion');
            $codigocie=explode("-", $request->get('ciess'));
            $id_cie=CIE::select('id')->where('codigo','=',$codigocie[0])->get();
            $historial->id_cie = $id_cie[0]->id;
            $historial->fecha = date('Y-m-d');
            $historial->hora = date('H:i');
            $historial->save();
            return response()->json(['success'=>'true']);
            // $message="El paciente fue cargado exitosamente";
            
            // return redirect()->action("PacientesController@index")->with('success',$message);
        
    }
}
