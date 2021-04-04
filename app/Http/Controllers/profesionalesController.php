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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario = Auth::user();
        return view('profesionales.index', compact('usuario')); #view('profesionales.index', compact ('profesional'))
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $especialidades = Especialidad::all();
        return view('profesionales.create', compact('especialidades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
            'documento' => 'required'
        ], $mensajes);
        if (Profesional::where('id_user', Auth::id())->get()->isEmpty()){
            $profesional = Profesional::create([
                'nombre' => $request->nombre,
                'apellido' => $request->apellido,
                'matricula' => $request->matricula,
                'domicilio' => $request->domicilio,
                'documento' => $request->dni,
                'id_user' => Auth::id(),
                'disponibilidad' => 1,
            ]);
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function atenciones()
    {
        return view('profesionales.atenciones');
    }
}
