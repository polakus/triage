<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Profesional;
use App\Especialidad;
use App\DetalleProfesional;

use DB;

class profesionalesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        // $usuario = Auth::user();
        // return view('profesionales.index', compact('usuario')); #view('profesionales.index', compact ('profesional'))
    }

    public function create()
    {
        $especialidades = Especialidad::all();
        return view('profesionales.create', compact('especialidades'));
    }

    public function store(Request $request){
        $mensajes = [
            'required' =>'Este campo no debe estar vacio.',
            'max' => 'Este campo supera la capacidad máxima de caracteres.',
            'unique' => 'Este valor ya existe en la base de datos.'
        ];
        $pr = $request->validate([
            'nombre' => 'required|max:255',
            'apellido' => 'required|max:255',
            'matricula' => 'required|unique:profesionales',
            'domicilio' => 'required|max:255',
            // 'documento' => 'required'
        ], $mensajes);
        if (Profesional::where('id_user', Auth::id())->get()->isEmpty()){
   
            $profesional = new Profesional;
            $profesional->nombre = $request->nombre;
            $profesional->apellido = $request->apellido;
            $profesional->matricula = $request->matricula;
            $profesional->domicilio = $request->domicilio;
            $profesional->telefono = $request->telefono;
            $profesional->documento = $request->dni;
            $profesional->id_user = Auth::id();
            $profesional->disponibilidad=1;
            $profesional->save();
            foreach($request->esp as $especialidad){
                $newDet = new DetalleProfesional;
                $newDet->id_profesional = $profesional->id;
                $newDet->id_especialidad = $especialidad;
                $newDet->save();
            }
            $request->session()->flash('alert-success', 'Los datos se han agregado correctamente!');
        }else{
            $request->session()->flash('alert-warning', 'Usted ya cargó su perfil!');
        }
        return redirect()->back()->withInput();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function atenciones()
    {
        return view('profesionales.atenciones');
    }
}
