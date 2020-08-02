<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paciente;

class controladorPacientes extends Controller
{

    public function index()
    {
        //
    }
    public function preguntas(Request $request){
        
        $id=$request->get('id');
        return view('triagepreguntas.index', compact('id'));
    }

    public function pacientes()
    {
        return view ('pacientes.pacientes');
    }

    public function formulario(Request $request)
    {
        return view('pacientes.pacientesRegistro');
    }

    public function muestra(Request $request)
    {
        $doc = $request->get('doc');
        $pacientes = Paciente::where('dni',$doc)->get();
        return view('pacientes.muestraPacientes', compact('pacientes', 'doc'));
    }

    public function triaje()
    {
        $pacientes=Paciente::where('dni',$_GET['dni'])->get();
        if($pacientes->count()){
            $rta="el dni del paciente ingresado ya está cargado.";
        }else{
            $nuevo = new Paciente;
            $nuevo->dni=$_GET['dni'];
            $nuevo->nombre=$_GET['nombre'];
            $nuevo->apellido=$_GET['apellido'];
            $nuevo->direccion=$_GET['direccion'];
            $nuevo->telefono=$_GET['telefono'];
            $nuevo->fechaNac=$_GET['fechaNac'];
            $nuevo->sexo=$_GET['sexo'];
            $nuevo->save();
            $pacientes=Paciente::where('dni',$_GET['dni']);
        }
        $doc=$_GET['dni'];
        return view('pacientes.muestraPacientes', compact('pacientes', 'doc'));        
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
    public function prueba($doc)# ignorar es solo para hacer pruebas
    {
        $pacientes=Paciente::where('dni', $doc)->get();
        if($pacientes->count()){
            echo "se encontro paciente ".$pacientes->count();
        }else{
            echo "no se encontro paciente ".$pacientes->count();
        }
    }
}
